<?php
defined('ISRUN') OR exit('Direct access to the script not allowed!');


$http = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off' ? 'https://' : 'http://';
$host = filter_input(INPUT_SERVER, 'HTTP_HOST');
$pahti = pathinfo($_SERVER['PHP_SELF']);
$basePath = $host == 'localhost' ? $http.$host.$pahti['dirname'] : $http.$host;

define('BASEURL', $basePath);

define('APPPATH', BASEPATH.DS.'app');
define('VIEWSPATH', APPPATH.DS.'views');
define('CTRLSPATH', APPPATH.DS.'controllers');
define('MDLSPATH', APPPATH.DS.'models');
define('COREPATH', SYSPATH.DS.'Core');
define('HANDLRPATH', COREPATH.DS.'Handlers');

if(ENV == 'development' && file_exists(COREPATH.DS.'Helpers'.DS.'dev_helpr.php'))
{
    require_once COREPATH.DS.'Helpers'.DS.'dev_helpr.php';
}
require_once COREPATH.DS.'Helpers'.DS.'basic_helpr.php';



require SYSPATH.DS.'Application.php';

require COREPATH.DS.'Router.php';

function autloadBaseHandlers($className)
{
    $classPath = $className.'.php';
    
    if(file_exists($classPath))
    {
        include_once $classPath;
    }
    vdx($className);
}
spl_autoload_register('autloadBaseHandlers');

require HANDLRPATH.DS.'Input'.DS.'InputsCheck.php';
require HANDLRPATH.DS.'Input'.DS.'InputsManage.php';

require CTRLSPATH.DS.'mainCtrl.php';



use Sys\Application;

(new Application());