<?php

namespace Core;

use Contracts\Middleware;
use Core\Response\Response;
use Core\Request\Request;
/**
 * Description of MiddlewarePipeline
 */
class MiddlewarePipeline {
    
    private $pipes = [];
    
    public function addPipe( Middleware $pipe)
    {
        $this->pipes[] = $pipe;
    }
    
    public function pipeline( Request $request, Response $response)
    {       
        $response->setBaseUrl($request->getBaseUrl());
        
        return $this->__invoke($request, $response);
    }
    
    public function __invoke( Request $request, Response $response ) 
    {
        $pipes = array_shift($this->pipes);
        if($pipes === NULL)
        {
            return $response;
        }
        return $pipes->process($request, $response, $this);
    }
    
}
