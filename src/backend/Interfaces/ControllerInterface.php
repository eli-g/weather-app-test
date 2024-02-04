<?php
namespace Ellie\Interfaces;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

interface ControllerInterface {

  public function actionExists(string $action) : bool;
  public function call(string $action, Request $request) : Response;

}