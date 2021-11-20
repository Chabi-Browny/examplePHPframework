<?php
defined('ISRUN') OR exit('Direct access to the script not allowed!');

namespace Core;

use Core\Containers\ServiceContainer;
use Core\Containers\Config;
use Core\Request\RequestFactory;

class Application {
    
    private static $instance;
        
    private function __construct(){}
    
    public static function init()
    {
        if(self::$instance == NULL)
        {
            self::$instance = new self();
        }
        return self::$instance;
    }
    
    public function run( Config $config ,ServiceContainer $serviceContainer)
    {
        try
        {
            session_start();
            
            $serviceContainer->add('config', $config);
                        
            $response = $serviceContainer
                ->get(MiddlewarePipeline::class)
                ->pipeline( $serviceContainer->get(RequestFactory::class), new Response\Response([], '', 200, 'Ok'));
            
            $serviceContainer->get(Response\ResponseEmitter::class)->emit($response);
        }
        catch(\Exception $errorReport)
        {
            echo 'Something went wrong: ';
            print_r($errorReport->getMessage());
            die();
        }
    }

}