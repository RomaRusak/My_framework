<?php

namespace App\Controllers;

use Core\Basics\BaseController;
use App\Interfaces\ControllerInterface;

class HomeController extends BaseController implements ControllerInterface {
    public function index() {
        $viewData = [
            'basePage' => 'layout',
            'title'    => 'home', 
            'content'  => 'home'
        ];
        $this->render($viewData);
    }
}