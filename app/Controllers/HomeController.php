<?php

namespace App\Controllers;

/**
 * Description of HomeController
 */
class HomeController extends \Core\Controller{
    
    public function index()
    {
        return $this->setView('public', ['title'=>'Főoldal']);        
    }
    
    /**
     * @desc - just for test
     * @return $this
     */
    public function teszt()
    {
        return $this->setRedirect('/');        
    }
    
}
