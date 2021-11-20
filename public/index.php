<?php 
declare (strict_types = 1);

ini_set('display_error', '1');
error_reporting(E_ALL);

define('ISRUN', microtime());
$environment = 
        [
            'prod' => 'production',
            'ontest' => 'online-test',
             'dev' => 'development'
        ];

define('ENV', $environment['dev']);

defined('DS') OR define('DS', DIRECTORY_SEPARATOR);
defined('BASEPATH') OR define('BASEPATH', dirname(__DIR__));
defined('SYSPATH') OR define('SYSPATH', BASEPATH.DS.'system');

if(file_exists(SYSPATH.DS.'sys.php'))
{
    require_once SYSPATH.DS.'sys.php';
}
else
{
    header('503 Service Unavailable', true, 503);
    die();
}