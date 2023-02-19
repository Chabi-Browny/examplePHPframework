<?php

namespace Examp\Core\Middleware;

use Examp\Contracts\Middleware;

use Examp\Core\MiddlewarePipeline;
use Examp\Core\Request\Request;
use Examp\Core\Response\Response;
/**
 * Description of FlashMessageCleanupMiddleware
 */
class CleanupFlashMiddleware extends MiddlewarePipeline implements Middleware
{
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
