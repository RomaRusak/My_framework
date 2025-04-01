<?php
use Core\Router;
use Core\RequestData;
use App\Controllers\HomeController;
use App\Controllers\NotFoundController;
use Core\RouteHandlerCreator;
use Core\RouteHandler;
use Core\DB\DBClass;
use App\Models\Product;

// errors
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . '/vendor/autoload.php';

$db  = new DBClass;
$db->init();
$db->connectToDB();
$PDO = $db->getPDO();

$productModel = new Product($PDO);
$productModel->getAll();

$homeController      = new HomeController;
$notFoundController  = new NotFoundController;

$routeHandlerCreator = new RouteHandlerCreator(RouteHandler::class);
$requestData         = new RequestData;
$router              = new Router($requestData, $routeHandlerCreator);

$router
    ->addRoute([
        'controller'    => $homeController,
        'action'        => 'index',
        'url'           => '/',
        'requestMethod' => 'GET',
    ])
    ->addRoute([
        'controller'    => $notFoundController,
        'action'        => 'index',
        'url'           => '/not_found',
        'requestMethod' => 'GET',
    ])
    ->addRoute([
        'controller'    => $notFoundController,
        'action'        => 'index',
        'url'           => '/not_found',
        'requestMethod' => 'POST',
    ]);

$router->handleRequest();