<?php

namespace Examp\Core\Handlers;

class Session {
    
    static private $_isSessRun = FALSE;

//    private static function __construct() {}
    
    /**
     * @desc - start the session
     */
    static public function sessStart()
    {
        if( self::$_isSessRun === FALSE)
        {
            session_start();
            self::$_isSessRun = TRUE;
        }
    }
    
    /**
     * @desc - settin up a session value with key
     * @param type $sessKey
     * @param type $sessValue
     * @return boolean
     */
    static public function sessSet($sessKey, $sessValue)
    {
        if( !empty($sessKey) && !empty($sessValue))
        {
            $_SESSION[$sessKey] = $sessValue;
        }
        return FALSE;
    }
    
    /**
     * @desc - get the specific session, or the hole session
     * @param type $sessKey
     * @return boolean
     */
    static public function sessGet($sessKey='') 
    {
        if( !empty($sessKey) && isset($_SESSION[$sessKey]))
        {
            return $_SESSION[$sessKey];
        }
        else if( empty($sessKey) )
        {
            return $_SESSION;
        }
        else
        {
            return FALSE;
        }
    }
    
    /**
     * @desc - destroy the session
     * @param type $unsetKey
     */
    static public function sessDestroy($unsetKey='') {
        if( self::$_isSessRun === TRUE )
        {
            if(!empty($unsetKey))
            {
                unset($_SESSION[$unsetKey]);
            }
            session_destroy();
            self::$_isSessRun = FALSE;
        }
    }

}