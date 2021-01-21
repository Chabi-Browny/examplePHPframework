<?php 
define('ISRUN', microtime());

define('DS', DIRECTORY_SEPARATOR);
define('BASEPATH', __DIR__);
define('SYSPATH', BASEPATH.DS.'system');
define('EXAMPPATH', SYSPATH.DS.'Examp');

//
$environment = 
        [
            'prod' => 'production',
            'ontest' => 'online-test',
             'dev' => 'development'
        ];

define('ENV', $environment['dev']);

if(file_exists(SYSPATH.DS.'sys.php'))
{
    require_once SYSPATH.DS.'sys.php';
}
else
{
    header('503 Service Unavailable', true, 503);
    die();
}