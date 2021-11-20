<?php
defined('ISRUN') OR exit('Direct access to the script not allowed!');

namespace Core;

use Core\View\ModelAndView;

class Controller {
    
    private $modelAndView;
    private $redriectTarget;
    private $flashMessage;
    
    public function __construct() 
    {
        $this->modelAndView = new ModelAndView();
    }
    
    public function setView(string $viewName, array $viewData = [])
    {
        $this->modelAndView->setViewName($viewName);
        $this->modelAndView->setViewData($viewData);
    }
    
    public function setRedirect(string $redirectTarget)
    {
        $this->redriectTarget = $redirectTarget;
    }
    
    public function getRedriectTarget(): ?string
    {
        return $this->redriectTarget;
    }
        
    public function setFlashMessage($flashMessage): void
    {
        $this->flashMessage = $flashMessage;
    }
    
    public function getFlashMessage()
    {
        return $this->flashMessage;
    }
    
    public function getModelAndView() : ModelAndView
    {
        return $this->modelAndView;
    }

}