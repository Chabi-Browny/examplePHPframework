<?php
defined('ISRUN') OR exit('Direct access to the script not allowed!');

use Core\Application;
use Core\Containers\ServiceContainer;

/**
 * @type array
 */
$services;
/**
 * @var $configs ConfigContainer
 */
$configs;
if(file_exists(SUPPORTPATH.DS.'services.php'))
{
    $services = require_once SUPPORTPATH.DS.'services.php';
}
if(file_exists(SUPPORTPATH.DS.'configs.php'))
{
    $configs = require_once SUPPORTPATH.DS.'configs.php';
}

Application::init()->run( $configs, new ServiceContainer($services));