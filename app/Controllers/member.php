<?php
defined('ISRUN') OR exit('Direct access to the script not allowed!');

use App\Ctrls\MainCtrl;

class Member extends MainCtrl{

    public function __construct()
    {    
        parent::__construct();
        if( !isset($this->_Data['islogd']) )
        {
            redirectTo('login');
        }
        $this->_Data['title'] = 'protected';
    }
    
    public function index()
    {
        $this->setView('protected', $this->_Data);
    }

}