<?php
session_cache_limiter(false);
session_start();

define('ROOT_PATH'          , __DIR__.'/../');
define('VENDOR_PATH'        , ROOT_PATH.'vendor/');
define('PUBLIC_PATH'        , ROOT_PATH.'public/');
define('APP_PATH'           , ROOT_PATH.'app/');
define('VAR_PATH'           , ROOT_PATH.'var/');

define('VIEW_PATH'          , APP_PATH.'views/');
define('CONFIG_PATH'        , APP_PATH.'config/');
define('ROUTES_PATH'        , APP_PATH.'routes/');

define('CACHE_PATH'         , VAR_PATH.'cache/');
define('LOG_PATH'           , VAR_PATH.'logs/');

require VENDOR_PATH.'autoload.php';

foreach (glob(CONFIG_PATH.'*.php') as $file) {
    require $file;
}

// Setup custom Twig view
$app = new \Slim\Slim($config['slim']);

// Prepare view
$view = $app->view();
$view->parserOptions = array(
    'charset' => 'utf-8',
    'cache' => realpath(CACHE_PATH),
    'auto_reload' => true,
    'strict_variables' => false,
    'autoescape' => true
);

//Twig Extra : helpers (urlFor, siteUrl, baseUrl, currentUrl)
$view->parserExtensions = array(
    new \Slim\Views\TwigExtension(),
);

//routes init
$router = new \App\Models\Router($app);
foreach (glob(ROUTES_PATH.'*.php') as $file) {
    require $file;
}


$app->run();
