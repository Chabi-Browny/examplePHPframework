<?php
defined('ISRUN') OR exit('Direct access to the script not allowed!');

use App\Ctrls\MainCtrl;
use Sys\Core\Handlers\Model;
use Sys\Core\Handlers\Input\InputsManage;
use Sys\Core\Handlers\Session;

class Login extends MainCtrl{
    
    protected $loginMdl='';

    public function __construct() 
    {
        parent::__construct();
        
        $this->loginMdl = (new Model())->getModel('loginMdl');
        
        $this->_Data['title'] = 'login';
    }
    
    public function index()
    {
        if( !empty($this->_Data['islogd']) )
        {
            redirectTo('member');
        }
        
        $this->setView('login', $this->_Data);
    }
    
    public function tryLogin()
    {
        if( isset($_POST['logn']))
        {
            $formCheckObj = new InputsManage();
            
            $formCheckObj->checkInput('usemail', 'email')
                         ->checkInput('usemail', 'isEmpty');
            
            $formCheckObj->checkInput('paw', 'minLength', 2)
                         ->checkInput('paw', 'isEmpty');
            
            if( $formCheckObj->scan() === TRUE)
            {
                $logResult = $this->loginMdl->getUserInfos($_POST['usemail'],  hash('SHA512', $_POST['paw']));
                if( $logResult !== FALSE)
                {
                    Session::sessSet('logdu', $logResult);
                    redirectTo('member');
                }
                else
                {
                    redirectTo('login');
                }
            }
            else
            {
                $this->_Data['formE']='Hiba a form kitöltésében';
            }
            
            $this->setView('login', $this->_Data);    
        }
        else
        {
            redirectTo('login');
        }
    }
    
    public function logout()
    {
        Session::sessDestroy();
        redirectTo();
    }

}