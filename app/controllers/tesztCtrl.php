<?php
//namespace App\Ctrls;

use Sys\Core\Handlers\Controller;

class TesztCtrl extends Controller{

    public function __construct() {
    }
    
    public function index()
    {
//        echo '-----------TesztCtrl-------------';
        $toData = 'ez adat!';
        
        $this->_Data = ['adat'=>'magyar', 'data'=>['data1','data2']];
        
        $this->setView('login', $this->_Data);
    }

}
