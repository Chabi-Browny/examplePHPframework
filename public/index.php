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
    //defined('') OR
    defined('EXAMPPATH') OR define('EXAMPPATH', SYSPATH.DS.'Examp');
    define('SUPPORTPATH', EXAMPPATH.DS.'support');

    if(ENV == 'development' && file_exists(SUPPORTPATH.DS.'helpers'.DS.'dev_helpr.php'))
    {
        require_once SUPPORTPATH.DS.'helpers'.DS.'dev_helpr.php';
    }

    if(file_exists(SUPPORTPATH.DS.'autoloaders.php'))
    {
        require_once SUPPORTPATH.DS.'autoloaders.php';
    }

    require_once SYSPATH.DS.'sys.php';

}
else
{
    header('503 Service Unavailable', true, 503);
    die();
}