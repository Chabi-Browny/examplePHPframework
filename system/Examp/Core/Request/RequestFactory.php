<?php

namespace Core\Request;

use Core\Containers\ServiceContainer;
use Core\Session\Session;
use Core\Url;

/**
 * Description of RequestFactory
 *
 */
class RequestFactory {
    
    private $services;
    
    public function __construct(ServiceContainer $container) {
        $this->services = $container;
    }
    
    public function createRequest()
    {
        return new Request( $this->services->get( Url::class ),
                            $_SERVER['REQUEST_METHOD'], 
                            getallheaders(),
                            file_get_contents('php://input'),
                            $this->services->get( Session::class ),
                            $_COOKIE, 
                            [ 'get' => $_GET, 'post' => $_POST]);
    }
    
}
