<?php

namespace App\Controllers;

/**
 * Description of MermberController
 */
class MermberController extends \Core\Controller{
    
    public function index()
    {
        $this->setView('public', ['title'=>'Tagoknak']);
        return $this;
    }
}

