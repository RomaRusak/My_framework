<?php

namespace App\Controllers;

use Core\BaseController;
use App\Interfaces\ControllerInterface;

class NotFoundController extends BaseController implements ControllerInterface {
    public function index() {
        echo 'Not Found!';
    }
}