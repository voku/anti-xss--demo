<?php

declare(strict_types=1);

error_reporting(E_ALL);
error_reporting(error_reporting() & ~E_NOTICE);
date_default_timezone_set('Europe/Berlin');

define('ROOT', dirname(__DIR__));

require ROOT . '/app/autoload.php';

[$app] = require ROOT . '/app/start.php';

$app->run();
