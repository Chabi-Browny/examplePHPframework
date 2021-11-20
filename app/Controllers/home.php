<?php
use App\Ctrls\MainCtrl;

class Home extends MainCtrl{

    public function __construct() {
    }
    
    public function index()
    {
        parent::__construct();
        $this->_Data['title'] = 'pubilc';
        
        $this->setView('public', $this->_Data);
    }

}