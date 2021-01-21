<?php
defined('ISRUN') OR exit('Direct access to the script not allowed!');

namespace Examp;

use Examp\Core\Handlers\Session;
use Examp\Core\Handlers\Controller;

class Application {
    
    public function __construct() 
    {
        //session start
        Session::sessStart();
        
        //call the system controller
        (new Controller())->getController();
    }

}