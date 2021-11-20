<?php


$config = new Core\Containers\Config();

$config->add('basePath', BASEPATH);

$config->add('dbDriver', 'mysql');
$config->add('dbHost', 'localhost');
$config->add('dbName', 'prio_db');
$config->add('dbUser', 'root');
$config->add('dbPass', '');

return $config;