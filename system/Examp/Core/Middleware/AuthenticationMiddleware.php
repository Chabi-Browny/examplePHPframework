<?php

namespace Examp\Core\Middleware;

use Examp\Core\Request\Request;
use Examp\Core\Response\Response;
use Examp\Core\Session\Session;
use Examp\Contracts\Middleware;

/**
 * Description of AuthenticationMiddleware
 */
class AuthenticationMiddleware implements Middleware{
    
    private $protectedLinks;
    
    public function __construct(array $protectedLinks)
    {
        $this->protectedLinks = $protectedLinks;
    }
    
    public function process(Request $request, Response $response, callable $next) 
    {
        $checkUri = array_filter($this->protectedLinks, function($uri) use ($request)
        {
            return preg_match('%/'.$uri.'%', $request->getUri());
        });
        
        if( !empty($checkUri) && !$this->isLogged( $request->getSession() ) )
        {
            return $response->redirect('/');
        }
        
        return $next($request, $response);
    }

    public function isLogged(Session $session)
    {
        return $session->has('logged');
    }
    
}
