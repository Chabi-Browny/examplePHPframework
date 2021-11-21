<?php

namespace Examp\Core;

class Router {

    public function __construct() {
        
    }
    
    /**
     * @desc - get the specific part of the URL / or the exploded URL string in array
     * @param type $uriPart
     * @return boolean
     */
    public function deflector( $uriPart = FALSE )
    {
        $uriStr = $this->_getUri();
        if( $uriStr !== FALSE)
        {
            $expUri = explode('/', '/'.$uriStr);
            
            if( is_int($uriPart) && isset($expUri[$uriPart]) )
            {
                //return String
                return strtolower($expUri[$uriPart]);
            }
            else
            {
                //return Array
                return $expUri;
            }
        }
        return FALSE;//////////////e helyére kell majd egy 404re irányitó
    }
    
    /**
     * @desc - check the URL string is valid 
     * @return boolean
     */
    private function _getUri()
    {
//        $uri = urldecode( parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) ); ////////////lehet jó de majd később
        
        $uriStr = isset($_REQUEST['uri']) ? trim(strip_tags($_REQUEST['uri']) ) : '';
        
        $uriPattern = '/^[A-z0-9\_\-\+%.&#?\=\/][^;\ \<\>\(\´\)\'\"]{0,}$/';
        if(preg_match($uriPattern, $uriStr) || empty($uriStr))
        {
            return htmlspecialchars($uriStr, ENT_QUOTES, 'UTF-8');
        }
        return FALSE;
    }

}