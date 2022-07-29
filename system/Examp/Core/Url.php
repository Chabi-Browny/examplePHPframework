<?php
namespace Core;

use Core\Helpers\StringCleaner;
/**
 * Description of Url
 */
class Url {
    
    public function getBaseUrl(): string
    {
        $checkHttps = isset($_SERVER['HTTPS']) && strtolower($_SERVER['HTTPS']) !== 'off' ? 'https://' : 'http://';
        $host = filter_input(INPUT_SERVER, 'HTTP_HOST');
        $pathInfo = pathinfo($_SERVER['PHP_SELF']);
        return $host == 'localhost' ? $checkHttps.$host.$pathInfo['dirname'] : $checkHttps.$host;
    }
    
    public function getFullUrl(): string
    {
        return $this->getBaseUrl().$this->getFullUri();
    }
    
    public function getFullUri(): string
    {       
        return $this->getUri();
    }
    
    private function getUri(): string
    {        
        $getUri = $_SERVER['REQUEST_URI'] ?? '/';
        $stringCleaner = new StringCleaner();
        $rtrimUri = $stringCleaner->setUncleanedData($getUri)->trimBothSides()->getCleanedData();
        if (empty($rtrimUri)) 
        {
            $rtrimUri = '/';
        }
        return $stringCleaner->htmlSpecial($rtrimUri)->getCleanedData(); 
    }
    
}
