<?php

namespace Core\Basics;
use Core\Templater\Templater;

class BaseController {

    protected $templater = null;

    public function __construct($templater)
    {
        $this->templater = $templater;
    }
}