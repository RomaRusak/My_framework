<?php

namespace Core\Basics;

class BaseController {
    public function render(array $viewData) 
    {
        extract($viewData);

        $basePagePath        = $_SERVER['DOCUMENT_ROOT'] . "/App/Views/$basePage.php";
        $isBasePageExists    = file_exists($basePagePath);

        switch ($isBasePageExists) {
            case true:
                require_once $basePagePath;
            break;
            case false:
                require_once $_SERVER['DOCUMENT_ROOT'] . "/App/Views/notFound.php";
            break;
        }   
    }
}