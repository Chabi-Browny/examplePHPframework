<?php
defined('ISRUN') OR exit('Direct access to the script not allowed!');

//defined('') OR 
defined('EXAMPPATH') OR define('EXAMPPATH', SYSPATH.DS.'Examp');
defined('APPPATH') OR define('APPPATH', BASEPATH.DS.'app');
define('VIEWSPATH', APPPATH.DS.'views');
define('CTRLSPATH', APPPATH.DS.'controllers');
define('MDLSPATH', APPPATH.DS.'models');

define('COREPATH', EXAMPPATH.DS.'Core');
define('SUPPORTPATH', EXAMPPATH.DS.'support');
define('HANDLRPATH', COREPATH.DS.'Handlers');

if(ENV == 'development' && file_exists(SUPPORTPATH.DS.'helpers'.DS.'dev_helpr.php'))
{
    require_once SUPPORTPATH.DS.'helpers'.DS.'dev_helpr.php';
}


if(file_exists(SUPPORTPATH.DS.'autoloaders.php'))
{
    require_once SUPPORTPATH.DS.'autoloaders.php';
}

/**/
if(file_exists(SUPPORTPATH.DS.'services.php'))
{
    $services = require_once SUPPORTPATH.DS.'services.php';
}
if(file_exists(SUPPORTPATH.DS.'configs.php'))
{
    $configs = require_once SUPPORTPATH.DS.'configs.php';
}

use Core\Application;
use Core\Containers\ServiceContainer;

Application::init()->run( $configs, new ServiceContainer($services));