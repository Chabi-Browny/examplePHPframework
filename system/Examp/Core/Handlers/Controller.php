<?php
defined('ISRUN') OR exit('Direct access to the script not allowed!');

namespace Examp\Core\Handlers;

use Examp\Core\Handlers\Views;
use Examp\Core\Handlers\Files;

class Controller {
    
    protected $_Data=[];
    protected $_FormErrors=[];
    
    private $_defaultMeth = 'index';
    private $_defaultCtrl = 'home';
    
    public function __construct() {}
    
    /**
     * @desc - get the scpecific Controller, or the default Controller
     * @return type
     */
    public function getController($ctrlName, $methName)
    {
        $ctrlClassName = !empty($ctrlName) ? $ctrlName : $this->_defaultCtrl;
        
        $ctrlPath = (new Files())->searchFile($ctrlClassName, CTRLSPATH);
        
        if( isset($ctrlPath['path']) && file_exists($ctrlPath['path']) )
        {
            include_once $ctrlPath['path'];
            $methodName = !empty($methName) ? $methName : $this->_defaultMeth;

            $classObj = new $ctrlClassName();
            
            if(is_callable([$classObj, $methodName]))
            {
                return $classObj->$methodName();
            }
            else
            {
                //maybe 400
                vdx('hibás a link');
            }
        }
        else
        {
            // 404
            vdx('Nem található az oldal!');
        }
    }
    
    /**
     * @desc - call the View and it is setting up the front end
     * @param type $currentViewName
     * @param type $currentViewData
     */
    public function setView($currentViewName, $currentViewData)
    {
        (new Views($currentViewName, $currentViewData));
    } 

}