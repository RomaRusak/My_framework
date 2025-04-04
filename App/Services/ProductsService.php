<?php

namespace App\Services;

class ProductsService {
    public function validateDataBeforeInsert(array $unvalidatedData): array {
        $validatedData = [
            'productName'       => null, 
            'productPrice'      => null,
            'areAllParamsVal'   => false,
            'productNameErrors' => null,
            'productPriceErrors'=> null,
        ];
        
        $validatedData['productName']        = trim($unvalidatedData['productName']);
        $validatedData['productPrice']       = +trim($unvalidatedData['productPrice']);
        $validatedData['productNameErrors']  = $this->getErrors('productName', $validatedData['productName']);
        $validatedData['productPriceErrors'] = $this->getErrors('productPrice', $validatedData['productPrice']);
        $validatedData['areAllParamsVal']    = !count($validatedData['productNameErrors']) 
                                                && !count($validatedData['productPriceErrors']);
        
        return $validatedData;
    }

    private function getErrors(string $key, string|int $checkedParam): array {
        $errors = [];

        $rules = [
            'productName' => [
                function($checkedParam) {
                    return mb_strlen($checkedParam) > 2 ?: 'product name must be more than 2 characters long.';
                },
                function($checkedParam) {
                    return mb_strlen($checkedParam) < 255 ?: '"Product name must be less than 255 characters long."';
                },
            ],

            'productPrice' => [
                function($checkedParam) {
                    return $checkedParam > 0 ?: 'price must be more than 0!';
                },
            ],
        ];

        foreach($rules[$key] as $check) {
            $checkResult = $check($checkedParam);
            if(is_string($checkResult)) {
                $errors[] = $checkResult;
            };
        }

        return $errors;
    }
}

