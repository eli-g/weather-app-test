<?php
namespace Ellie;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use League\Plates\Engine;

abstract class Controller {

  /**
   * Returns true if the controller responds to $action
   */
  public function actionExists(string $action) : bool {
    return method_exists($this,$action.'Action');
  }

  /**
   * Call $action
   */
  public function call(string $action, Request $request) : Response {
    $method = $action.'Action';
    return $this->$method($request);
  }

  protected function getTemplateEngine() {
    $projectRoot = realpath(__DIR__ . '/..');
    return new Engine($projectRoot.'/templates');
  }

}