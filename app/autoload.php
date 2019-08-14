<?php

/*
|--------------------------------------------------------------------------
| Register The Composer Auto Loader
|--------------------------------------------------------------------------
|
| Composer provides a convenient, automatically generated class loader
| for our application. We just need to utilize it! We'll require it
| into the script here so that we do not have to worry about the
| loading of any our classes "manually". Feels great to relax.
|
 */

require ROOT . '/vendor/autoload.php';

/*
|--------------------------------------------------------------------------
| Register The AntiXssSlim Auto Loader
|--------------------------------------------------------------------------
|
| We register an auto-loader "behind" the Composer loader that can load
| model classes on the fly.
|
 */

// auto-loader to load classes in /app/models/
\spl_autoload_register(
    function ($class) {
        if (\strpos($class, 'Model_') !== 0) {
            return;
        }

        if (\is_file($file = ROOT . '/app/models/' . $class . '.php')) {
            require $file;
        }
    }
);
