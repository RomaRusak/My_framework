<?php

use Core\Router\Router;
use Core\Router\RequestData;
use App\Controllers\HomeController;
use App\Controllers\NotFoundController;
use App\Controllers\ProductsController;
use Core\Router\RouteHandlerCreator;
use Core\Router\RouteHandler;
use Core\DB\DBClass;
use App\Models\Product;
use App\Services\ProductsService;
require_once __DIR__ . '/vendor/autoload.php';

// errors
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$db  = new DBClass;
$db->init();
$db->connectToDB();
$PDO = $db->getPDO();

$productModel        = new Product($PDO);

$productsService     = new ProductsService();

$homeController      = new HomeController;
$notFoundController  = new NotFoundController;
$productsController  = new ProductsController($productModel, $productsService);

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
    ])
    ->addRoute([
        'controller'    => $productsController,
        'action'        => 'index',
        'url'           => '/products',
        'requestMethod' => 'GET',
    ])
    ->addRoute([
        'controller'    => $productsController,
        'action'        => 'create',
        'url'           => '/products/create',
        'requestMethod' => 'GET',
    ])
    ->addRoute([
        'controller'    => $productsController,
        'action'        => 'store',
        'url'           => '/products',
        'requestMethod' => 'POST',
    ]);

$router->handleRequest();