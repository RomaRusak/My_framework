<?php

namespace Core\Basics;

class BaseController {

    private $notFoundPagePath = null;

    public function __construct()
    {
        $this->notFoundPagePath = $_SERVER['DOCUMENT_ROOT'] . "/App/Views/notFound.php";
    }

    public function render(array $viewData) 
    {
        extract($viewData);
        var_dump($viewData);

        $basePagePath        = $_SERVER['DOCUMENT_ROOT'] . "/App/Views/$basePage.php";
        $isBasePageExists    = file_exists($basePagePath);

        switch ($isBasePageExists) {
            case true:
                require_once $basePagePath;
            break;
            case false:
                require_once $this->notFoundPagePath;
            break;
        }   
    }
}