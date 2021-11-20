<?php

namespace Core\Middleware;

use Core\Request\Request;
use Core\Response\Response;

/**
 * Description of AuthenticationMiddleware
 */
class AuthenticationMiddleware implements \Contracts\Middleware{
    
    private $protectedLinks;
    
    public function __construct(array $protectedLinks)
    {
        $this->protectedLinks = $protectedLinks;
    }
    
    public function process(Request $request, Response $response, callable $next) 
    {
        if( in_array($request->getUri(), $this->protectedLinks) && !$this->isLogged() )
        {
            return $response->redirect('/');
        }
        
        return $next($request, $response);
    }

    public function isLogged()
    {
        return TRUE;
    }
    
}
