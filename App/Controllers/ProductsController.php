<?php

namespace App\Controllers;

use Core\Basics\BaseController;
use App\Interfaces\ControllerInterface;
use App\Interfaces\ModelInterface;
use Core\Router\RequestData;
use App\Services\ProductsService;
use App\Services\ProductsServiceUI;
use Core\Templater\Templater;

class ProductsController extends BaseController implements ControllerInterface {
    private $productModel      = null;
    private $productsService   = null;
    private $productsServiceUI = null;

    public function __construct(
        Templater       $templater,
        ModelInterface  $productModel,
        ProductsService $productsService,
        ProductsServiceUI $productsServiceUI
        )
    {
        parent::__construct($templater);

        $this->productModel      =  $productModel;
        $this->productsService   = $productsService;
        $this->productsServiceUI = $productsServiceUI;
    }
    
    public function index(): void
    {
        $allProducts     = $this->productModel->getAll();
        $allProductsHTML = $this->productsServiceUI->getAllProductsHTML($allProducts, 'ul');

        $this->templater->render([
            'basePage'        => 'layout',
            'pageTitle'       => 'products', 
            'content'         => 'Templates/products',
            'mainTitle'       => 'All Products',
            'allProducts'     =>  $allProductsHTML,
        ]);
    }

    public function create(): void
    {
        $productFormHTML = $this->productsServiceUI->getProductFormHTML();
        
        $this->templater->render([
            'basePage'    => 'layout',
            'pageTitle'   => 'create_product', 
            'mainTitle'   => 'Add product',
            'content'     => 'Templates/productsCreate',
            'productForm' =>  $productFormHTML,
        ]);
    }

    public function store(RequestData $requestData)
    {
        $POSTParams = $requestData->getPOSTParams();
        
        $validatedData = $this->productsService->validateDataBeforeInsert([
            'productName'  => $POSTParams['productName'],
            'productPrice' => $POSTParams['productPrice'],
        ]);

        if (!$validatedData['areAllParamsVal']) {
            $productFormHTML = $this->productsServiceUI->getProductFormHTML($validatedData);

            $this->templater->render([
                'basePage'    => 'layout',
                'pageTitle'   => 'create_product', 
                'mainTitle'   => 'Add product',
                'content'     => 'Templates/productsCreate',
                'productForm' =>  $productFormHTML,
            ]);
            
            return;
        }
        
        $this->productModel->create($validatedData);

        $this->create();

        header('Location: /products');
        exit();
    }
}