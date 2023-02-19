<?php
function autoloadSystemClasses($className)
{
    $ds = DIRECTORY_SEPARATOR;
//    $prefix = 'Examp';
    
    $systemPath = dirname(dirname(__DIR__));

    $classPath = strtr( $systemPath . $ds . $className . '.php', '/\\', $ds.$ds);

    if(file_exists($classPath))
    {
        include_once $classPath;
    }
}
spl_autoload_register('autoloadSystemClasses');

function autoloadAppClasses($className)
{
    $classPath = strtr( BASEPATH . DS . lcfirst($className) . '.php', '/\\', DS.DS);

    if(file_exists($classPath))
    {
        include_once $classPath;
    }
}
spl_autoload_register('autoloadAppClasses');