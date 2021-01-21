<?php

namespace Sys\Core\Handlers;

use Sys\Core\Handlers\Database;

class Model{
    
    public $dbObj = '';
    
    public function __construct() {
        $this->dbObj = (new Database());
    }
    
    /**
     * @desc - get the needed model
     * @param type $getMdlName
     * @return boolean
     */
    public function getModel($getMdlName)
    {
        
        $mdlPath = (new Files())->searchFile($getMdlName, MDLSPATH);

        if( file_exists($mdlPath['path']) )
        {
            include_once $mdlPath['path'];
            
            $mdlClassName = $getMdlName;
            
            return (new $mdlClassName());
        }
        else
        {
            return FALSE;
        }
    }

}