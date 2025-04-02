<?php

namespace App\Interfaces;

interface RequestDataInterface {
    public function getReqMethod();
    public function getReqUrl();
    public function getGetParams();
    public function getPOSTParams();
}