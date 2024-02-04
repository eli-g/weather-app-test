<?php
$projectRoot = realpath(__DIR__ . '/..');

// Set project root as include path
set_include_path($projectRoot);
require_once $projectRoot . '/vendor/autoload.php';

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\File\Exception\FileNotFoundException;
use Ellie\Router;

$request = Request::createFromGlobals();

$router = new Router();

try {
  $router->execute($request)->send();
} catch(FileNotFoundException $e) {
  $response = new Response($e->getMessage(),404);
  $response->send();
}


?>