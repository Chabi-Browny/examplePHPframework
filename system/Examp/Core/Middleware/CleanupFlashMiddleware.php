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
    /**
     * @desc - the makes a flash layer from the last response layer in the middlewares
     * @param Request $request
     * @param Response $response
     * @param callable $next
     * @return Response
     */
    public function process( Request $request, Response $response, callable $next ): Response
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
