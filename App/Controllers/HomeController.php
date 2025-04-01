<?php

namespace App\Controllers;

use Core\BaseController;
use App\Interfaces\ControllerInterface;

class HomeController extends BaseController implements ControllerInterface {
    public function index() {
        echo 'Home page';
    }
}