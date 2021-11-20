<?php

namespace Core;

/**
 * Description of Url
 */
class Url {
    
    public function getBaseUrl()
    {
        $checkHttps = isset($_SERVER['HTTPS']) && strtolower($_SERVER['HTTPS']) !== 'off' ? 'https://' : 'http://';
        $host = filter_input(INPUT_SERVER, 'HTTP_HOST');
        $pathInfo = pathinfo($_SERVER['PHP_SELF']);
        return $host == 'localhost' ? $checkHttps.$host.$pathInfo['dirname'] : $checkHttps.$host;
    }
    
    public function getFullUrl()
    {
        return $this->getBaseUrl().$this->getFullUri();
    }
    
    public function getFullUri()
    {       
        return $this->getUri();
    }
    
    private function getUri()
    {        
        $getUri = $_SERVER['REQUEST_URI'] ?? '/';
        
        $rtrimUri = rtrim(
                            strip_tags(
                                    trim($getUri))
                        , '/');
        
        if(empty($rtrimUri))
        {
            $rtrimUri = '/';
        }
        
        return htmlspecialchars($rtrimUri, ENT_QUOTES, 'UTF-8');
    }
    
}
