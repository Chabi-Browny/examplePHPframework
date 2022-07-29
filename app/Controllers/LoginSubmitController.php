<?php
namespace App\Controllers;

use Core\Controller;
use Core\Containers\ServiceContainer;
use Core\Handlers\Input\InputsManager;

use App\Services\LoginSubmitService;
/**
 * Description of LoginSubmitController
 */
class LoginSubmitController extends Controller {

    /**
     * @var LoginSubmitService
     */
    private $loginService;
    /**
    * @var InputsManager
    */
    private $inputManager;

    public function __construct( ServiceContainer $container )
    {
        parent::__construct();

        $this->inputManager = $container->get(InputsManager::class);
        $this->loginService = $container->get(LoginSubmitService::class);
    }

    public function submit()
    {
        $retVal = NULL;

        $this->inputManager->setFilter('usemail', 'require|email|maxLength:50');
        $this->inputManager->setFilter('paw', 'require|minLength:2');
        if ( $this->inputManager->scan() === TRUE )
        {
            $loginCheck = $this->loginService->login($this->inputManager->getPost('usemail'), $this->inputManager->getPost('paw'));
            if ( $loginCheck === TRUE )
            {
                $retVal = $this->setRedirect('protected');
            }
            else
            {
                $this->setFlashData('logSubError', 'Login failiure', 'warn');
                $retVal = $this->setRedirect('login');
            }
        }
        else
        {
            $this->setFlashData(  'logForError', [ 'error' => ['Login form error', 'Some data is not correct'] ] );
            $retVal = $this->setRedirect('login');
        }
        return $retVal;
    }

    /**/
    public function logout()
    {
        if ($this->loginService->logout()) {
            return $this->setRedirect('login');
        }
        return $this->setRedirect('/');
    }

}
