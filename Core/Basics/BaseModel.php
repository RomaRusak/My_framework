<?php

namespace Core\Basics;
use PDO;

class BaseModel {
    protected $PDO = null;

    public function __construct(PDO $PDO)
    {
        $this->PDO = $PDO;
    }
} 