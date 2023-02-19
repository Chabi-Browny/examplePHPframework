<?php

namespace Examp\Core\Middleware;

use Examp\Core\Controller;
use Examp\Core\Request\Request;
use Examp\Core\Response\Response;
use Examp\Core\Response\ResponseFactory;
use Examp\Core\Dispatcher;
use Examp\Contracts\Middleware;

use Exception;
/**
 * Description of DispatcherMiddleware
 */
class DispatcherMiddleware implements Middleware{
    
    private $dispatcher;
    private $resonseFactory;
    
    public function __construct( Dispatcher $dispatcher, ResponseFactory $resonseFactory) 
    {
        $this->dispatcher = $dispatcher;
        $this->resonseFactory = $resonseFactory;
    }   
    
    public function process( Request $request, Response $response, callable $next) 
    {
        $controllerResponse = $this->dispatcher->dispatch($request);
        
        if (!$controllerResponse instanceof Controller)
        {
            throw new Exception('Missing instance: ' . Controller::class);
        }
        
        return $this->resonseFactory->createResponse($controllerResponse, $request, $response);
    }
    
}
