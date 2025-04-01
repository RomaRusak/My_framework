<?php

namespace App\Controllers;
use App\Interfaces\ControllerInterface;

class NotFoundController implements ControllerInterface {
    public function index() {
        echo 'Not Found!';
    }
}