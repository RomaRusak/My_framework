<?php

namespace Core;

use App\Interfaces\ControllerInterface;

class RouteHandler {
    private $controller = null;
    private $action    = null;

    public function __construct(
        ControllerInterface $controller,
        string              $action,
    )
    {
        $this->controller = $controller;
        $this->action     = $action;
    }

    public function getController()
    {
        return $this->controller;
    }

    public function getAction()
    {
        return $this->action;
    }
}