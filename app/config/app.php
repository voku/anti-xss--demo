<?php

return [
    'debug' => ($_SERVER['APP_ENV'] ?? 'development') !== 'production',
    'twig'  => [
        'templates.path'   => ROOT . '/app/views',
        'cache'            => ROOT . '/app/storage/cache/twig',
        'auto_reload'      => true,
        'strict_variables' => false,
    ],
];
