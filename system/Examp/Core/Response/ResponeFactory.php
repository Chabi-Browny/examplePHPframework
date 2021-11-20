<?php

namespace Core\Response;

use Core\Request\Request;
use Core\View\ViewRenderer;
/**
 * Description of ResponeFactory
 */
class ResponeFactory {
    
    private $viewRenderer;
    
    public function __construct( ViewRenderer $viewRenderer) 
    {
        $this->viewRenderer = $viewRenderer;
    }
    
    public function createResponse( \Core\Controller $controllerReponse, Request $request, Response $response)
    {
        $redirectTarget = $controllerReponse->getRedriectTarget();      
        
        if ( is_string($redirectTarget) )
        {
            vdx($controllerReponse->getRedriectTarget());
        }
        else
        {                       
            $modelAndViewObj = $controllerReponse->getModelAndView();
            $viewName = $modelAndViewObj->getViewName();
            
            $viewDataMerge = array_merge($modelAndViewObj->getViewData(), ['baseUrl' => $request->getBaseUrl()]);
            
            $response->setBody($this->viewRenderer->render($viewName, $viewDataMerge));
            return $response;
        }
        
    }
    
}
