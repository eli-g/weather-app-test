<?php
namespace Ellie\Controllers;

use Ellie\Interfaces\ControllerInterface;
use Ellie\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class IndexController extends Controller implements ControllerInterface {

  protected function indexAction(Request $request) : Response {
    $templates = $this->getTemplateEngine();
    return new Response($templates->render('index', ['pageTitle' => 'Met No Weather App']));
  }

}

?>