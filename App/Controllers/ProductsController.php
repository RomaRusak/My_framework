<?php

namespace App\Controllers;

use Core\Basics\BaseController;
use App\Interfaces\ControllerInterface;
use App\Interfaces\ModelInterface;
use App\Interfaces\RequestDataInterface;
use App\Services\ProductsService;
use Core\Templater\Templater;

class ProductsController extends BaseController implements ControllerInterface {
    private $productModel    = null;
    private $productsService = null;

    public function __construct(
        Templater       $templater,
        ModelInterface  $productModel,
        ProductsService $productsService
        )
    {
        parent::__construct($templater);
        $this->productModel    =  $productModel;
        $this->productsService = $productsService;
    }
    
    public function index(): void
    {
        $allProducts = $this->productModel->getAll();

        $this->templater->render([
            'basePage'    => 'layout',
            'pageTitle'   => 'products', 
            'content'     => 'Templates/products',
            'mainTitle'   => 'All Products',
            'allProducts' =>  $allProducts,
        ]);
    }

    public function create(): void
    {
        $this->templater->render([
            'basePage'  => 'layout',
            'pageTitle' => 'create_product', 
            'mainTitle' => 'Add product',
            'content'   => 'Templates/productsCreate',
        ]);
    }

    public function store(RequestDataInterface $requestData)
    {
        $POSTParams = $requestData->getPOSTParams();
        
        $validatedData = $this->productsService->validateDataBeforeInsert([
            'productName'  => $POSTParams['productName'],
            'productPrice' => $POSTParams['productPrice'],
        ]);

        if (!$validatedData['areAllParamsVal']) {
            $this->templater->render([
                'basePage'      => 'layout',
                'pageTitle'     => 'create_product', 
                'content'       => 'Templates/productsCreate',
                'mainTitle' => 'Add product',
                'validatedData' => $validatedData,
            ]);
            
            return;
        }
        
        $this->productModel->create($validatedData);

        $this->create();

        header('Location: /products');
        exit();
    }
}