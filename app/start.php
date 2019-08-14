<?php

use Slim\Slim;
use Slim\Views\TwigExtension;
use voku\helper\AntiXSS;
use voku\twig\AntiXssExtension;

// for native PHP session
\session_start();

/*
|--------------------------------------------------------------------------
| protect against XSS attacks
|--------------------------------------------------------------------------
|
| The first thing we will do, is to protect the web-application against
| XSS-attacks, via AntiXSS.
|
 */

/**
 * clear the string || array via AntiXSS::xss_clean();
 *
 * @param array $array   WARNING: this is a reference not a variable!!!
 * @param       $antiXSS AntiXSS
 */
function clearXss(array &$array, AntiXSS $antiXSS)
{
    foreach ($array as &$value) {
        if (\is_array($value)) {
            clearXss($value, $antiXSS);
        } else {
            $value = $antiXSS->xss_clean($value);
        }
    }
}

$antiXss = new AntiXSS();
//clearXss($_POST, $antiXss); // we use "AntiXSS for Twig" in the template, so we can save the xss thingy in the database
//clearXss($_GET, $antiXss); // ''
//clearXss($_REQUEST, $antiXss); // ''
clearXss($_SERVER, $antiXss);
clearXss($_SESSION, $antiXss);
clearXss($_COOKIE, $antiXss);
unset($antiXss);

/*
|--------------------------------------------------------------------------
| Create DB connection
|--------------------------------------------------------------------------
|
| The next thing we will do, is create a DB connection via ActiveRecord.
|
 */

require ROOT . '/app/dbloader.php';

/*
|--------------------------------------------------------------------------
| Create Slim Application
|--------------------------------------------------------------------------
|
| Now, we will create a new Slim application instance
| which serves as the "glue" for all the components of this web-application.
|
 */

$app = new Slim(require_once ROOT . '/app/config/app.php');
$app->setName('AntiXssSlim');

/*
 * set some globally available view-data
 */
$resourceUri = $_SERVER['REQUEST_URI'];
$rootUri = $app->request()->getRootUri();
$assetUri = $rootUri;
$app->view()->appendData(
    [
        'app'         => $app,
        'rootUri'     => $rootUri,
        'assetUri'    => $assetUri,
        'resourceUri' => $resourceUri,
    ]
);

// include all controllers
foreach (\glob(ROOT . '/app/controllers/*.php', GLOB_NOSORT) as $router) {
    include $router;
}

/*
|--------------------------------------------------------------------------
| configure Twig
|--------------------------------------------------------------------------
|
| The application uses Twig as its template engine. This script configures
| the template paths and adds some extensions.
|
 */

$view = $app->view();
$view->parserOptions = [
    'debug'            => false,
    'cache'            => ROOT . '/app/storage/cache/twig',
    'auto_reload'      => true,
    'strict_variables' => false,
];

$antiXss = new AntiXSS();
$view->parserExtensions = [
    new TwigExtension(),
    new AntiXssExtension($antiXss),
];

/*
|--------------------------------------------------------------------------
| Return The Application
|--------------------------------------------------------------------------
|
| This script returns the application instance. The instance is given to
| the calling script so we can separate the building of the instances
| from the actual running of the application and sending responses.
|
 */

return $app;
