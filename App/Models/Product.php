<?php

namespace App\Models;

use App\Interfaces\ModelInterface;
use Core\Basics\BaseModel;
use App\Interfaces\CreatableInterface;
use PDO;
use PDOException;

class Product extends BaseModel implements ModelInterface, CreatableInterface {
    public function __construct(PDO $PDO)
    {
        parent::__construct($PDO);
    }

    public function getAll() 
    {
        try {
            $products = $this->PDO->query("SELECT * FROM `products`")->fetchAll(PDO::FETCH_ASSOC);
            
            return $products;
        
        } catch (PDOException $e) {
            echo "Error while executing the query." . $e->getMessage();
        }
    }

    public function create(array $productData) 
    {
        try {
            ['productName' => $productName, 'productPrice' => $productPrice] = $productData;
            $query = "INSERT INTO `products` (product, price) VALUES (:productName, :productPrice)";

            $sth = $this->PDO->prepare($query);
            $sth->bindParam(':productName', $productName, PDO::PARAM_STR);
            $sth->bindParam(':productPrice', $productPrice, PDO::PARAM_INT);

            $sth->execute();
        } catch(PDOException $e) {
            echo "Error while executing the query." . $e->getMessage();
        }
    }
}