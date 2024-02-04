<?php
namespace Ellie;

use Ellie\Controllers\IndexController;
use Symfony\Component\HttpFoundation\File\Exception\FileNotFoundException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class Router {

  public function __construct() {

  }

  public function execute(Request $request) : Response {

    $pathInfo = explode('/',$request->getPathInfo());

    array_shift($pathInfo);

    if($pathInfo[0] == '') {
      $pathInfo = ['index','index'];
    }

    //Find the right controller from the first part of the request URI
    $className = 'Ellie\\Controllers\\'.ucfirst($pathInfo[0]).'Controller';

    if(!class_exists($className))
      throw new FileNotFoundException($request->getPathInfo());

    $controller = new $className();

    $action = $pathInfo[1];

    if(!$controller->actionExists($action))
      throw new FileNotFoundException($request->getPathInfo());

    return $controller->call($action, $request);

  }

}