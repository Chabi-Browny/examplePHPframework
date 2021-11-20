<?php

namespace Core\Session;

/**
 * Description of Flash
 */
class Flash implements \Contracts\Session
{
    const FLASHSTORAGE = 'flashes';
    
    public function has(string $key) 
    {
        $this->checkOrMakeFlashStorage();
        
        if ( array_key_exists($key, $_SESSION[self::FLASHSTORAGE]) )
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }
    
    public function add(string $key, $value) 
    {
        $this->checkOrMakeFlashStorage();
        if ( !array_key_exists($key, $_SESSION[self::FLASHSTORAGE]) )
        {
            $_SESSION[self::FLASHSTORAGE][$key] = $value;
        }
        
    }

    public function get(string $key) 
    {
        if ( array_key_exists($key, $_SESSION[self::FLASHSTORAGE]) )
        {
            return $_SESSION[self::FLASHSTORAGE][$key];
        }
    }

    public function getAll()
    {
        if ( $this->checkOrMakeFlashStorage() === TRUE )
        {
            return $_SESSION[self::FLASHSTORAGE];
        }
    }
    
    public function remove(string $key) 
    {
        unset($_SESSION[self::FLASHSTORAGE][$key]);
    }
    
    public function clearAll()
    {
        unset($_SESSION[self::FLASHSTORAGE]);
    }
    
    protected function checkOrMakeFlashStorage(): ?bool
    {
        if ( !array_key_exists(self::FLASHSTORAGE, $_SESSION) )
        {
            $_SESSION[self::FLASHSTORAGE] = [];
        }
        else
        {
            return TRUE;
        }
    }

}
