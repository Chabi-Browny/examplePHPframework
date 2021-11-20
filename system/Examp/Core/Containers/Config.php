<?php

namespace Core\Containers;

/**
 * Description of Config
 */
class Config implements \Contracts\Containers{

    private $configs = [];    
    
    public function has(string $key) 
    {
        return array_key_exists($key, $this->configs);
    }
    
    public function add(string $key, $value) 
    {
        if($this->has($key))
        {
            throw new \Exception('The config under this key ('.$key.') is already exists!');
        }
        
        $this->configs[$key] = $value;
    }

    public function get(string $key) 
    {
        if($this->has($key))
        {
            return $this->configs[$key];
        }
        else
        {
            throw new \Exception('There is no config under this key: '.$key.'!');
        }
    }
    
}
