<?php

namespace App\Services;

class ProductsServiceUI {

    private $errorsData       =  [
        'productName'  => [],
        'productPrice' => [],
    ];

    private $defaultInputsData = [
        'productName' => [
            "labelText"       => "Product name",
            "inputAttributes" => [
                "value" => "",
                "type"  =>"text", 
                "name"  => "productName", 
                "id"    => "productName", 
            ],
        ],
        'productPrice' => [
            "labelText"       => "Product price",
            "inputAttributes" => [
                "value" => "",
                "type"  => "number", 
                "name"  => "productPrice", 
                "id"    => "productPrice", 
            ],
        ],
    ];

    private function getLabelHTML(string $labelText, $inputId): string 
    {
        return "<label for=\"$inputId\">$labelText</label>";
    }

    private function getInputHTML(array $inputData)
    {
        $attibutes = '';

        foreach ($inputData as $attr => $attVal) {
            $attibutes .= "$attr = \"$attVal\"";
        }

        return "<input $attibutes required>";
    }

    private function getSubmitButtonHTML(): string
    {
        return '<button type="submit">Add product</button>';
    }

    private function getErrorsHTML(array $errors)
    {
        $errorsHTML = '';

        foreach ($errors as $errorText) {
            $errorsHTML .= "<li><p>$errorText</p></li>";
        }

        return "<ul>$errorsHTML</ul>";
    }

    private function updateInputsData(array $inputsData, array $validatedData): array
    {

        foreach ($inputsData as $inputName => &$inputData) {
            $inputData['inputAttributes']['value'] = $validatedData[$inputName];
        }

        return $inputsData;
    }

    private function updateErrorsData(array $errorsData, array $validatedData): array
    {
        $errorKeys = ['productName', 'productPrice']; 

        foreach ($errorKeys as $key) {
            $errorKey = $key . 'Errors'; 

            if (!empty($validatedData[$errorKey])) {
                $errorsData[$key] = $validatedData[$errorKey]; 
            }
        }

        return $errorsData;
    }

    public function getProductFormHTML(array $validatedData = []): string
    {
        $inputsData            = $this->defaultInputsData;
        $errorsData            = $this->errorsData;
        $openTag               = '<form action="/products" method="POST">';
        $closeTag              = "</form>";
        $productFormHTML       = '';
        $submitButtonHTML      = $this->getSubmitButtonHTML();
        
        if (!empty($validatedData)) {
            $inputsData = $this->updateInputsData($inputsData, $validatedData);
            $errorsData = $this->updateErrorsData($errorsData, $validatedData);
        }

        foreach ($inputsData as $inputName => $inputData) {
            $labelHTML  = $this->getLabelHTML($inputData['labelText'], $inputData['inputAttributes']['id']); 
            $inputHTML  = $this->getInputHTML($inputData['inputAttributes']);
            $errorsHTML = '';
            $errors = $errorsData[$inputName];
            
            if (!empty($errors)) {
                $errorsHTML = $this->getErrorsHTML($errors);
            }
            
            $productFormHTML .= "<div>$labelHTML $inputHTML $errorsHTML</div>";
        }
    
        return "$openTag $productFormHTML $submitButtonHTML $closeTag";
    }

    public function getAllProductsHTML(array $allProducts, string $tagVal): string
    {
        $openTag         = "<$tagVal>";
        $closeTag        = "</$tagVal>";
        $allProductsHTMl = "";

        foreach ($allProducts as $product) {
            $productHTML = "<li>" . 'product: ' . $product['product'] . ' price: ' . $product['price'] . '</li>';
            $allProductsHTMl .= $productHTML;
        }
        
        return "$openTag $allProductsHTMl $closeTag";
    }
}