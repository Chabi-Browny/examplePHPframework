<?php

namespace App\Controllers;

use Core\Containers\ServiceContainer;
use Core\Handlers\Input\InputsManager;
/**
 * Description of LoginSubmitController
 */
class LoginSubmitController extends \Core\Controller{
    
    private $container;
    private $loginService;
    private $inputManager;
    
    public function __construct( ServiceContainer $container ) 
    {
        parent::__construct();
//        $this->container = $container;
        $this->inputManager = $container->get(InputsManager::class);
    }
    
    public function submit()
    {        
        //input beolvasás
        //validálás
        //adat lekérés
        //eredmény
        $this->inputManager->setFilter('usemail', 'isEmpty|email|maxLength:50');
        $this->inputManager->setFilter('paw', 'isEmpty|minLength:2');
        
        vdx($this->inputManager->scan());
        
        if ( $this->inputManager->scan() === TRUE )
        {
            
            $this->setRedirect('/');///protected
        }
        else
        {
            //redirectto: login
            $this->setRedirect('login');
        }
        return $this;
    }
    
}
