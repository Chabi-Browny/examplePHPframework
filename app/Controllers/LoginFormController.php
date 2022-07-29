<?php
namespace App\Controllers;

use Core\Controller;
use Core\Session\Session;
/**
 * Description of LoginControllers
 */
class LoginFormController extends Controller{
    
    private $session;
    
    public function __construct(Session $session)
    {
        parent::__construct();
        $this->session = $session;
    }
    
    public function index()
    {
        if (!$this->session->has('logged'))
        {
            return $this->setView('login', [ 'title' => 'Login!']);            
        }
        else
        {
            return $this->setRedirect('/');
        }
    }
    
}
