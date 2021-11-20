<?php

use Core\Containers\ServiceContainer;

use Core\Database;
use Core\Dispatcher;
use Core\Handlers\Input\InputsManager;
use Core\Request\RequestFactory;
use Core\Response\ResponseEmitter;
use Core\Response\ResponeFactory;
use Core\Session\Session;
use Core\View\ViewRenderer;
use Core\Url;

use App\Services\LoginSubmitService;

return [
    
    Url::class => new Url(),
    Session::class => new Session(),
    Database::class => function( ServiceContainer $container )
    {
        $config = $container->get('config');
        return new Database($config);
    },
    ViewRenderer::class => function( ServiceContainer $container )
    {
        $config = $container->get('config');
        return new ViewRenderer( $config->get('basePath') );
    },
    ResponeFactory::class => function( ServiceContainer $container )
    {
        return new ResponeFactory($container->get(ViewRenderer::class));
    },
    RequestFactory::class => function( ServiceContainer $container )
    {
        // it gives back the Request class
        return (new RequestFactory($container))->createRequest();
    },
    Dispatcher::class => function( ServiceContainer $container )
    {
        $dispatcher = new Dispatcher('notFoundCtrl',$container);
        
        $dispatcher->addRoute('/', 'homeCtrl');
        $dispatcher->addRoute('/login', 'loginFormCtrl');
        $dispatcher->addRoute('/login/trylogin', 'loginSubmitCtrl::submit', 'post');
        $dispatcher->addRoute('/protected', 'mermberCtrl');
        
        return $dispatcher;
    },
    Core\MiddlewarePipeline::class => function( ServiceContainer $container )
    {
        $authenticationPipe = new Core\Middleware\AuthenticationMiddleware(['member']);
        $dispatcherPipe = new Core\Middleware\DispatcherMiddleware( $container->get(Dispatcher::class), $container->get(ResponeFactory::class) );
        
        $pipeline = new Core\MiddlewarePipeline();
        
        $pipeline->addPipe($authenticationPipe);
        $pipeline->addPipe($dispatcherPipe);
        
        return $pipeline;
    },
    ResponseEmitter::class => new ResponseEmitter(), 
    InputsManager::class => function ( ServiceContainer $container )
    {
        return new InputsManager( $container->get(RequestFactory::class) );
    },
            
    LoginSubmitService::class => function( ServiceContainer $container )
    {
        return new LoginSubmitService( $container->get(Database::class) );
    },
            
    'notFoundCtrl' => new App\Controllers\NotFoundController(),
    'homeCtrl' => new App\Controllers\HomeController(),
    'mermberCtrl' => new App\Controllers\MermberController(),
    'loginFormCtrl' => new App\Controllers\LoginFormController(),
    'loginSubmitCtrl' => function( ServiceContainer $container )
    {
        return new \App\Controllers\LoginSubmitController( $container );
    },
];