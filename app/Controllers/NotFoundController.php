<?php

namespace App\Controllers;

/**
 * Description of NotFoundController
 */
class NotFoundController extends \Core\Controller{
    
    public function index()
    {
        $this->setView('404');
        return $this;
    }
    
}
