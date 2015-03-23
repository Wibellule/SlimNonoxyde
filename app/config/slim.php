<?php
use App\Lib\Config;

Config::write('path', 'http://localhost/Slim/SlimNonoxyde/');

//Error Reporting
ini_set('display_errors', 'On');
error_reporting(E_ALL);

//Slim configuration
$config['slim'] = array(
    // Modular
    'modular'       => true,

    // Application
    'mode'          => 'development',

    // Debugging
    'debug'         => true,

    // Logging
    'log.writer'    => new \Slim\Logger\DateTimeFileWriter(array(
        'path'          => LOG_PATH,
        'name_format'   => 'y-m-d'
    )),
    'log.level'     => \Slim\Log::DEBUG,
    'log.enabled'   => true,

    //View
    'view'          => new \Slim\Views\Twig(),
    'templates.path'=> VIEW_PATH,

    // HTTP
    'http.version' => '1.1',

    // Routing
    'routes.case_sensitive' => true
);
