<?php
session_cache_limiter(false);
session_start();

define('ROOT_PATH'          , __DIR__.'/../');
define('VENDOR_PATH'        , ROOT_PATH.'vendor/');
define('PUBLIC_PATH'        , ROOT_PATH.'public/');
define('APP_PATH'           , ROOT_PATH.'App/');
define('VAR_PATH'           , ROOT_PATH.'var/');

define('VIEW_PATH'          , APP_PATH.'Views/');
define('CONFIG_PATH'        , APP_PATH.'Config/');

define('LOG_PATH'           , VAR_PATH.'logs/');

require VENDOR_PATH.'autoload.php';

foreach (glob(CONFIG_PATH.'*.php') as $file) {
    require $file;
}

// Setup custom Twig view
$app = new \Slim\Slim($config['slim']);

//Twig helpers (urlFor, siteUrl, baseUrl, currentUrl)
$view = $app->view();
$view->parserExtensions = array(
    new \Slim\Views\TwigExtension(),
);

new App\Models\Router($app);


$app->run();
