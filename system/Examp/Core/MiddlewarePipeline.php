<?php
namespace Examp\Core;

use Examp\Contracts\Middleware;
use Examp\Core\Response\Response;
use Examp\Core\Request\Request;
/**
 * Description of MiddlewarePipeline
 */
class MiddlewarePipeline
{    
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
