<?php

namespace Core\Middleware;

use Core\Request\Request;
use Core\Response\Response;
use Core\Response\ResponseFactory;
use Core\Dispatcher;
/**
 * Description of DispatcherMiddleware
 */
class DispatcherMiddleware implements \Contracts\Middleware{
    
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
        
        return $this->resonseFactory->createResponse($controllerResponse, $request, $response);
    }
    
}
