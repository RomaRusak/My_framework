<?php

namespace App\Controllers;

use Core\Basics\BaseController;
use App\Interfaces\ControllerInterface;

class NotFoundController extends BaseController implements ControllerInterface {
    public function index(): void {
        $this->render(['basePage' => 'notFound',]);
    }
}