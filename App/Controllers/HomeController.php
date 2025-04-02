<?php

namespace App\Controllers;

use Core\Basics\BaseController;
use App\Interfaces\ControllerInterface;

class HomeController extends BaseController implements ControllerInterface {
    public function index(): void {
        $viewData = [
            'basePage' => 'layout',
            'title'    => 'home', 
            'content'  => 'home'
        ];
        $this->render($viewData);
    }
}