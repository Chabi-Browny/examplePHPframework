<?php

namespace Examp\Core\Response;

/**
 * Description of Response
 */
class Response
{    
    protected $header;
    protected $body;
    protected $statusCode;
    protected $reasonPhrase;
    protected $protocol;
    protected $baseUrl;
    
    public function __construct( array $header, string $body, int $statusCode, string $reasonPhrase)
    {
        $this->header = $header;
        $this->body = $body;
        $this->statusCode = $statusCode;
        $this->reasonPhrase = $reasonPhrase;
        $this->protocol = $_SERVER['SERVER_PROTOCOL'];
    }
    
    public function getProtocol() 
    {
        return $this->protocol;
    }
        
    public function getHeader() 
    {
        return $this->header;
    }

    public function getBody()
    {
        return $this->body;
    }
    
    public function setBody($body): void 
    {
        $this->body = $body;
    }
    
    public function getStatusCode() 
    {
        return $this->statusCode;
    }

    public function getReasonPhrase() 
    {
        return $this->reasonPhrase;
    }
    
    public function setBaseUrl(string $baseUrl)
    {
        $this->baseUrl = $baseUrl;
    }
    
    public function redirect(string $target)
    {
        if ( $target === '/' )
        {
            $target = '';
        }
        //target ellenőrzés
        return new self(
            [ 'Location' => $this->baseUrl.'/'.$target ],
            '',
            302, 'Found'
        );
    }
    
}
