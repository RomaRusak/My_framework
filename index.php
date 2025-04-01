<?php
use Core\Router;
use Core\RequestData;
use App\Controllers\HomeController;
use Core\RouteHandlerCreator;
use Core\RouteHandler;

// errors
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . '/vendor/autoload.php';

$homeController      = new HomeController;

$routeHandlerCreator = new RouteHandlerCreator(RouteHandler::class);
$requestData         = new RequestData;
$router              = new Router($requestData, $routeHandlerCreator);

// $router->addRoute($homeController, 'index');
$router
    ->addRoute([
        'controller'    => $homeController,
        'action'        => 'index',
        'url'           => '/',
        'requestMethod' => 'GET',
    ])
    ->addRoute([
        'controller'    => $homeController,
        'action'        => 'index',
        'url'           => '/',
        'requestMethod' => 'POST',
    ]);

$router->handleRequest();