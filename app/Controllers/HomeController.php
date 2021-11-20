<?php

namespace App\Controllers;

/**
 * Description of HomeController
 */
class HomeController extends \Core\Controller{
    
    public function index()
    {
        $this->setView('public', ['title'=>'Főoldal']);
        return $this;
    }
    
    public function teszt()
    {
        $this->setRedirect('/');
        return $this;
    }
    
}
