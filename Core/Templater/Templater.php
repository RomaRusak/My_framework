<?php

namespace Core\Templater;

class Templater {

    private $viewData = null;

    private function setViewData($viewData)
    {
        $this->viewData = $viewData;
    }

    private function getContent($fileName)
    {
        $path = $_SERVER['DOCUMENT_ROOT'] . "/App/Views/$fileName.php";

        return file_get_contents($path);
    }

    private function replacePlaceholders($content)
    {
        foreach ($this->viewData as $key => $value) {
            if (strpos($content, "{{ $key }}")) {
                $content = str_replace("{{ $key }}", $value, $content);
            }
        }

        return $content;
    }
    
    private function addReqTemplates($content)
    {
        preg_match_all('/\{\{\s*require\((.*?)\)\s*\}\}/', $content, $matches);

        foreach($matches[0] as $key => $value) {
            $reqTempName = $matches[1][$key];
            $reqTempContent = $this->getContent($reqTempName);
            $reqTempContent = $this->replacePlaceholders($reqTempContent);

            $content = str_replace($value, $reqTempContent, $content);
            
        } 
        return $content;
    }

    private function includeTemplates($content)
    {
        preg_match_all('/\{\{\s*include\((.*?)\)\s*\}\}/', $content, $matches);

        foreach($matches[0] as $key => $value) {
            $tempName = $matches[1][$key];
            
            if (isset($this->viewData[$tempName])) {
                $includedTempName    = $this->viewData[$tempName];
                $includedTempContent = $this->getContent($includedTempName);
                $includedTempContent = $this->replacePlaceholders($includedTempContent);

                $content = str_replace($value, $includedTempContent, $content);
            }
        } 

        return $content;
    }

    public function render($viewData)
    {
        $this->setViewData($viewData);

        $basePageName = $viewData['basePage'];
        
        $templateContent = $this->getContent($basePageName);
        $templateContent = $this->replacePlaceholders($templateContent);
        $templateContent = $this->includeTemplates($templateContent);
        $templateContent = $this->addReqTemplates($templateContent);

        ob_start(); 
        eval('?>' . $templateContent);
        $renderedContent = ob_get_clean();

        echo $renderedContent;
    }
}