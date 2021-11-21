<?php
defined('ISRUN') OR exit('Direct access to the script not allowed!');

namespace Examp;

use Examp\Core\Handlers\Session;
use Examp\Core\Router;
use Examp\Core\Handlers\Controller;

class Application {
    
    protected $_needCtrl = '';
    protected $_uriMeth = '';
    
//    private $_errorCtrl = 'error';
    
    public function __construct() 
    {
        //session start
        Session::sessStart();
        
        $routerObj = new Router();
        
        if(!is_array($uriPartOne = $routerObj->deflector(1)))
        {
            //set the needed controller based on the URL
            $this->_needCtrl = $uriPartOne;
        }
        
        if(!is_array($uriPartTwo = $routerObj->deflector(2)))
        {
            //set the needed method based on the URL
            $this->_uriMeth = $uriPartTwo;
        }
        
        //call the system controller
        (new Controller())->getController($this->_needCtrl, $this->_uriMeth);
    }

}