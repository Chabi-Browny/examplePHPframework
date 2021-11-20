<?php

namespace Core\Response;

/**
 * Description of ResponseEmitter
 */
class ResponseEmitter {
    
    public function emit(Response $response)
    {
        if( headers_sent() )
        {
            throw new \Exception("The header is already sent!");
        }
        
        $this->setStatusLine( $response->getProtocol(), $response->getStatusCode(), $response->getReasonPhrase());
        
        $this->setHeader($response->getHeader());
        
        $this->emitBody( $response->getBody() );
    }
    
    private function setStatusLine($protocol, $statusCode, $reasonPhrase)
    {
        $status = sprintf('%s %d %s', $protocol, $statusCode, $reasonPhrase);
        header($status, TRUE, $statusCode);
    }
    
    private function setHeader(array $headers)
    {
        foreach($headers as $name => $value)
        {
            header( sprintf('%s: %s', $name, $value), FALSE);
        }
    }
    
    private function emitBody(string $bodyContent)
    {
        echo $bodyContent;
    }
    
}
