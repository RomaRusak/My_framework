<?php

namespace App\Models;

use App\Interfaces\ModelInterface;
use Core\Basics\BaseModel;
use PDO;

class Product extends BaseModel implements ModelInterface {
    public function __construct(PDO $PDO)
    {
        parent::__construct($PDO);
    }

    public function getAll() {
        
    }
}