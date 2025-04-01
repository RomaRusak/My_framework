<?php

namespace Core;

use App\Interfaces\RequestDataInterface;

class Router {
    private $routes              = [];
    private $requestData         = null;
    private $routeHandlerCreator = null;

    public function __construct(
        RequestDataInterface  $requestData,
        RouteHandlerCreator   $routeHandlerCreator,
    )
    {
        $this->requestData         = $requestData;
        $this->routeHandlerCreator = $routeHandlerCreator;
    }

    public function addRoute(array $routeData)
    {
        [
            'controller'    => $controller, 
            'action'        => $action,
            'url'           => $url,
            'requestMethod' => $requestMethod
        ] = $routeData;

        $routeHandler = $this->routeHandlerCreator->createRouteHandler($controller, $action);
        $this->setRouts($url, $requestMethod, $routeHandler);
        
        return $this;
    }

    private function setRouts(string $url, string $requestMethod, RouteHandler $routeHandler): void {
        $this->routes[$url][$requestMethod] = $routeHandler;
    }

    public function handleRequest()
    {
        $reqMethod = $this->requestData->getReqMethod();
        $reqUrl    = $this->requestData->getReqUrl();

        if (!isset($this->routes[$reqUrl])) {
            $reqUrl = '/not_found';
        }

        $reqHandler = $this->routes[$reqUrl][$reqMethod];
        $controller = $reqHandler->getController();
        $action     = $reqHandler->getAction();

        $controller->$action();
    }
}