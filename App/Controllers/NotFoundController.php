<?php

namespace App\Controllers;

use Core\Basics\BaseController;
use App\Interfaces\ControllerInterface;
use Core\Templater\Templater;

class NotFoundController extends BaseController implements ControllerInterface {

    public function __construct(Templater $templater)
    {
        parent::__construct($templater);
    }

    public function index(): void {
        $viewData = [
            'basePage'  => 'notFound',
            'pageTitle' => 'not_found', 
            'mainTitle' => 'Page not found',
        ];
        $this->templater->render($viewData);
    }
}