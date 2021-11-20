<?php

namespace Contracts;

use Core\Response\Response;
use Core\Request\Request;
/**
 */
interface Middleware {

    public function process( Request $request, Response $response, callable $next);
    
}
