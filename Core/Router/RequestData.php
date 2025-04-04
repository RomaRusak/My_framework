<?php

namespace Core\Router;

class RequestData {
    private $reqMethod  = null;
    private $reqUrl     = null;
    private $GETParams  = null;
    private $POSTParams = null;
    
    public function __construct()
    {
        $this->reqMethod  = $_SERVER['REQUEST_METHOD'];
        $this->reqUrl     = $_SERVER['REQUEST_URI'];
        $this->GETParams  = $_GET;
        $this->POSTParams = $_POST;
    }

    public function getReqMethod()
    {
        return $this->reqMethod;
    }

    public function getReqUrl()
    {
        return $this->reqUrl;
    }

    public function getGETParams() 
    {
        return $this->GETParams;
    }

    public function getPOSTParams()
    {
        return $this->POSTParams;
    }
}