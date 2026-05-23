<?php

declare(strict_types=1);

use app\Twig\AntiXssFilterExtension;
use Slim\Factory\AppFactory;
use Slim\Views\Twig;
use voku\helper\AntiXSS;

\session_start();

function clearXss(array &$array, AntiXSS $antiXSS): void
{
    foreach ($array as &$value) {
        if (\is_array($value)) {
            clearXss($value, $antiXSS);

            continue;
        }

        if ($value !== null && !\is_object($value)) {
            $value = $antiXSS->xss_clean((string) $value);
        }
    }
}

$antiXss = new AntiXSS();
clearXss($_SERVER, $antiXss);
clearXss($_SESSION, $antiXss);
clearXss($_COOKIE, $antiXss);

require ROOT . '/app/dbloader.php';

$config = require ROOT . '/app/config/app.php';
$app = AppFactory::create();
$app->addRoutingMiddleware();
$app->addErrorMiddleware($config['debug'], true, true);

$twig = Twig::create(
    $config['twig']['templates.path'],
    [
        'cache'            => $config['debug'] ? false : $config['twig']['cache'],
        'auto_reload'      => $config['twig']['auto_reload'],
        'debug'            => $config['debug'],
        'strict_variables' => $config['twig']['strict_variables'],
    ]
);
$twig->getEnvironment()->addExtension(new AntiXssFilterExtension($antiXss));

foreach (\glob(ROOT . '/app/controllers/*.php', GLOB_NOSORT) as $router) {
    include $router;
}

return [$app, $twig];
