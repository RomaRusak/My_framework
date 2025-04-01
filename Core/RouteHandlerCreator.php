<?php

namespace Core;

use Core\RouteHandler;
use App\Interfaces\ControllerInterface;
use Exception;

class RouteHandlerCreator{

    private $routeHandlerClass = null;

    public function __construct($routeHandlerClass)
    {
        $this->routeHandlerClass = $routeHandlerClass;
    }

    private function checkIsActionExists ($controller, $action): bool
    {
        return in_array($action, get_class_methods($controller));
    }

    public function createRouteHandler(ControllerInterface $controller, string $action): RouteHandler
    {
        $isActionExists = $this->checkIsActionExists($controller, $action);

        if (!$isActionExists) {
            $controllerName = $controller::class;
            throw new Exception("The method $action is not implemented in $controllerName");
        }

        return new $this->routeHandlerClass($controller, $action);
    }
}