<?php
defined('ISRUN') OR exit('Direct access to the script not allowed!');

use App\Ctrls\MainCtrl;
use Examp\Core\Handlers\Model;
use Examp\Core\Handlers\Input\InputsManage;
use Examp\Core\Handlers\Session;

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
            
            $formCheckObj->setFilter('usemail', 'email')
                         ->setFilter('usemail', 'isEmpty');
            
            $formCheckObj->setFilter('paw', 'minLength', 2)
                         ->setFilter('paw', 'isEmpty');
            
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
        if( !empty($this->_Data['islogd']) )
        {
            Session::sessDestroy();
            redirectTo();
        }
    }

}