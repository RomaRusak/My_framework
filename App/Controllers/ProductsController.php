<?php

namespace App\Controllers;

use Core\Basics\BaseController;
use App\Interfaces\ControllerInterface;
use App\Interfaces\ModelInterface;
use App\Interfaces\RequestDataInterface;
use App\Services\ProductsService;

class ProductsController extends BaseController implements ControllerInterface {
    private $productModel    = null;
    private $productsService = null;

    public function __construct(
        ModelInterface  $productModel,
        ProductsService $productsService
        )
    {
        $this->productModel    =  $productModel;
        $this->productsService = $productsService;
    }
    
    public function index()
    {
        $allProducts = $this->productModel->getAll();

        $this->render([
            'basePage'    => 'layout',
            'title'       => 'products', 
            'content'     => 'products',
            'allProducts' =>  $allProducts,
        ]);
    }

    public function create()
    {
        $this->render([
            'basePage'    => 'layout',
            'title'       => 'create_product', 
            'content'     => 'productsCreate',
        ]);
    }

    public function store(RequestDataInterface $requestData)
    {
        $POSTParams = $requestData->getPOSTParams();
        
        $validatedData = $this->productsService->validateDataBeforeInser([
            'productName'  => $POSTParams['productName'],
            'productPrice' => $POSTParams['productPrice'],
        ]);

        if (!$validatedData['areAllParamsVal']) {
            $this->render([
                'basePage'      => 'layout',
                'title'         => 'create_product', 
                'content'       => 'productsCreate',
                'validatedData' => $validatedData,
            ]);
            
            return;
        }
        
        $this->productModel->addProduct($validatedData);

        $this->create();

        header('Location: /products');
        exit();
    }
}