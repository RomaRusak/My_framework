<?php

namespace Core\Basics;

class BaseController {
    public function render() 
    {
        require_once './App/Views/homePage.php';
    }
}