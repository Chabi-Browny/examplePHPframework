<?php

namespace Sys\Core\Handlers;

use Sys\Core\Handlers\Files;

class Views {
    
    public $currentViewData = '';
    public $currentViewName = '';
    
    public function __construct($getCurrentViewName, $getCurrentViewData = NULL ) 
    {
        //the called view name
        $this->currentViewName = $getCurrentViewName;
        //sended data to the front
        $this->currentViewData = !empty($getCurrentViewData) ? $getCurrentViewData : '';
        
        return $this->setViewFile('layout');
    }
    
    /**
     * @desc - call the needed view file
     * @param type $viewPart
     * @return boolean
     */
    public function setViewFile($viewPart)
    {
        $viewFullPath = (new Files())->searchFile( $viewPart, VIEWSPATH);
        
        if(file_exists($viewFullPath['path']))
        {
            include_once $viewFullPath['path'];
        }
        else
        {
            return FALSE;
        }
    }
}
