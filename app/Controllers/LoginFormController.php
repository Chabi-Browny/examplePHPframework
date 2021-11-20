<?php

namespace App\Controllers;

/**
 * Description of LoginControllers
 */
class LoginFormController extends \Core\Controller{
    
    public function index()
    {
        $this->setView('login');
        return $this;
    }
    
}
