<?php

namespace Core\Session;

class Session implements \Contracts\Session{
                   
    public function has(string $key)
    {
        return array_key_exists($key, $_SESSION);
    }
    
    public function get(string $key) 
    {
        if($this->has($key))
        {
            return $_SESSION[$key];
        }
    }

    public function getAll() 
    {
        return $_SESSION;
    }
    
    public function add(string $key, $value) 
    {
        if(!$this->has($key))
        {
            $_SESSION[$key] = $value;
        }
    }
    
    public function remove(string $key) 
    {
        unset($_SESSION[$key]);
    }

    public function clearAll() 
    {
        session_destroy();
    }
    
}