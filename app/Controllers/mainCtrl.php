<?php
defined('ISRUN') OR exit('Direct access to the script not allowed!');

namespace App\Ctrls;

use Examp\Core\Handlers\Controller;
use Examp\Core\Handlers\Session;

class MainCtrl extends Controller{

    public function __construct()
    {
        parent::__construct();
        if(  !empty(Session::sessGet('logdu')) )
        {
            $this->_Data['islogd'] = TRUE;
            $this->_Data['logdName'] = Session::sessGet('logdu')['u_name'];
        }
    }
}