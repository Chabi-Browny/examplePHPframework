<?php

namespace Core\View;

/**
 * Description of ModelAndView
 */
class ModelAndView {
    
    private $viewName;
//    private $viewData = [];
    private $viewData;
    
    public function getViewName() 
    {
        return $this->viewName;
    }

    public function getViewData() 
    {
        return $this->viewData;
    }

    public function setViewName($viewName): void 
    {
        $this->viewName = $viewName;
    }

    public function setViewData($viewData): void 
    {
        $this->viewData = $viewData;
    }
    
}
