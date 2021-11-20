<?php
function autoloadSystemClasses($className)
{
    $classPath = strtr(EXAMPPATH.DS.$className.'.php', '/\\', DS.DS);
//    vdx($classPath);
    if(file_exists($classPath))
    {
        include_once $classPath;
    }
}
spl_autoload_register('autoloadSystemClasses');

function autoloadAppClasses($className)
{
    $classPath = strtr(BASEPATH.DS.lcfirst($className).'.php', '/\\', DS.DS);
//    vdx($classPath);
    if(file_exists($classPath))
    {
        include_once $classPath;
    }
}
spl_autoload_register('autoloadAppClasses');