<?php

namespace Core\Middleware;

use Contracts\Middleware;

use Core\MiddlewarePipeline;
use Core\Request\Request;
use Core\Response\Response;
/**
 * Description of FlashMessageCleanupMiddleware
 */
class CleanupFlashMiddleware extends MiddlewarePipeline implements Middleware{

    public function process( Request $request, Response $response, $next )
    {
        $next = $next($request, $response);
        $flash = $request->getSession()->flash();
        if ( $next->getStatusCode() < 300)
        {
            $flash->clearAll();
        }
        
        return $next;
    }

}
