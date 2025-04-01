<?php

namespace Core;
use App\Interfaces\RequestDataInterface;

class RequestData implements RequestDataInterface {
    private $reqMethod = null;
    private $reqUrl    = null;
    
    public function __construct()
    {
        $this->reqMethod = $_SERVER['REQUEST_METHOD'];
        $this->reqUrl    = $_SERVER['REQUEST_URI'];
    }

    public function getReqMethod()
    {
        return $this->reqMethod;
    }

    public function getReqUrl()
    {
        return $this->reqUrl;
    }
}