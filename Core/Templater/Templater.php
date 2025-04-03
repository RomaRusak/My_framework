<?php

namespace Core\Templater;

class Templater {

    private $viewData = null;

    private function setViewData($viewData)
    {
        $this->viewData = $viewData;
    }

    private function getContent(string $fileName): string
    {
        $path = $_SERVER['DOCUMENT_ROOT'] . "/App/Views/$fileName.php";

        return file_get_contents($path);
    }

    private function replacePlaceholders(string $content): string
    {
        foreach ($this->viewData as $key => $value) {
            if (strpos($content, "{{ $key }}")) {
                $content = str_replace("{{ $key }}", $value, $content);
            }
        }

        return $content;
    }

    private function addTemplates(string $content, string $templateTypes): string
    {
        switch ($templateTypes) {
            case 'included':
                preg_match_all('/\{\{\s*include\((.*?)\)\s*\}\}/', $content, $matches);
            break;
            case 'required':
                preg_match_all('/\{\{\s*require\((.*?)\)\s*\}\}/', $content, $matches);
            break;
            default:
                return $content;
        }

        $placeholders = $matches[0];
        $templates    = $matches[1];

        foreach($placeholders as $placeholderKey => $placeholder) {
            switch($templateTypes) {
                case 'included':
                    $tempName = $this->viewData[$templates[$placeholderKey]];
                break;
                case 'required':
                    $tempName =  $templates[$placeholderKey];
                break;
            }
            
            $templateContent = $this->getContent($tempName);
            $templateContent = $this->replacePlaceholders($templateContent);

            $content = str_replace($placeholder, $templateContent, $content);
        } 

        return $content;
    }

    public function render(array $viewData): void
    {
        $this->setViewData($viewData);

        $basePageName = $viewData['basePage'];
        
        $templateContent = $this->getContent($basePageName);
        $templateContent = $this->replacePlaceholders($templateContent);
        $templateContent = $this->addTemplates($templateContent, 'included');
        $templateContent = $this->addTemplates($templateContent, 'required');

        ob_start(); 
        eval('?>' . $templateContent);
        $renderedContent = ob_get_clean();
        
        echo $renderedContent;
    }
}