<?php
namespace Ellie\Controllers;

use Ellie\Interfaces\ControllerInterface;
use Ellie\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use GuzzleHttp\Client;

class WeatherController extends Controller implements ControllerInterface {

  protected function getForecastAction(Request $request) {
    $client = new Client(['base_uri' => 'https://api.met.no/weatherapi/locationforecast/2.0/']);

    $response = $client->get('compact',[
      'query' => [
        'lat' => '65.58387',
        'lon' => '22.15221'
      ],
      'headers'  => [
        'User-Agent' => 'https://github.com/eli-g'
      ]
    ]);

    $forecasts = json_decode($response->getBody()->getContents());
    $labels = $this->getLabels();

    $parsedForecasts = [];

    foreach($forecasts->properties->timeseries as $forecast) {
      if(isset($forecast->data->next_1_hours)) {
        $day = new \DateTime($forecast->time);
        $label = explode('_',$forecast->data->next_1_hours->summary->symbol_code)[0];
        $parsedForecasts[$day->format('Y-m-d')][] = [
          'time' => $day->format('H:i'),
          'forecast' => $forecast->data->next_1_hours->summary->symbol_code,
          'labels' => $labels[$label]
        ];
      }
    }

    return new JsonResponse($parsedForecasts,200, ['']);
  }

  private function getLabels() {
    $projectRoot = realpath(__DIR__ . '/..');
    $csv = fopen($projectRoot.'/../icons/weather/legend.csv','r');
    $labels = [];
    while($line = fgetcsv($csv)) {
      $labels[$line[0]] = [
        'english' => $line[1],
        'norwegian' => $line[2]
      ];
    }
    return $labels;
  }

}

?>