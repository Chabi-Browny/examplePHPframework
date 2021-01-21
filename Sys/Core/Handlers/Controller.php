<?php
defined('ISRUN') OR exit('Direct access to the script not allowed!');

namespace Sys\Core\Handlers;

use Sys\Core\Router;
use Sys\Core\Handlers\Views;
use Sys\Core\Handlers\Files;

class Controller {
    
    protected $_Data=[];
    protected $_FormErrors=[];
    protected $_needCtrl = '';

    private $_uriMeth = 'index';
    private $_defaultCtrl = 'home';
//    private $_errorCtrl = 'error';
    
    public function __construct() 
    {
        $routerObj = new Router();
        if( $routerObj->deflector() !== FALSE )
        {
            if(!is_array($routerObj->deflector(1)))
            {
                //set the needed controller based on the URL
                $this->_needCtrl = $routerObj->deflector(1);
            }
            
            if(!is_array($routerObj->deflector(2)))
            {
                //set the needed method based on the URL
                $this->_uriMeth = $routerObj->deflector(2);
            }
        }
        else
        {
            //404
            vdx('Nem található az oldal!');
        }
        
    }
    
    /**
     * @desc - get the scpecific Controller, or the default Controller
     * @return type
     */
    public function getController()
    {
        $ctrlClassName = !empty($this->_needCtrl) ? $this->_needCtrl : $this->_defaultCtrl;
        
        $ctrlPath = (new Files())->searchFile($ctrlClassName, CTRLSPATH);
        
        if( isset($ctrlPath['path']) && file_exists($ctrlPath['path']) )
        {
            include_once $ctrlPath['path'];
            $methodName = $this->_uriMeth;
            
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