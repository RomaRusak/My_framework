<?php

namespace App\Controllers;

use Core\Basics\BaseController;
use App\Interfaces\ControllerInterface;
use Core\Templater\Templater;

class HomeController extends BaseController implements ControllerInterface {
    public function __construct(Templater $templater)
    {
        parent::__construct($templater);
    }

    public function index(): void {
        $viewData = [
            'basePage'  => 'layout',
            'pageTitle' => 'home', 
            'content'   => 'Templates/home',
            'mainTitle' => 'Home page',
        ];
        $this->templater->render($viewData);
    }
}