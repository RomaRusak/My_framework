<?php

namespace App\Interfaces;

interface RequestDataInterface {
    public function getReqMethod();
    public function getReqUrl();
}