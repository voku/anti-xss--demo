<?php
/**
 * Created by PhpStorm.
 * User: menadwork-user
 * Date: 04.11.2014
 * Time: 00:57
 */

/*
|--------------------------------------------------------------------------
| System Settings
|--------------------------------------------------------------------------
|
| Set the error reporting mode and time zone.
|
 */
error_reporting(E_ALL | E_STRICT);
error_reporting(error_reporting() & ~E_NOTICE);       // ignore error notice of undefined variables
date_default_timezone_set('Europe/Berlin');

define('ROOT', dirname(__DIR__));

/*
|--------------------------------------------------------------------------
| Register The Auto Loader
|--------------------------------------------------------------------------
|
| Composer provides a convenient, automatically generated class loader
| for our application. We just need to utilize it! We'll require it
| into the script here so that we do not have to worry about the
| loading of any our classes "manually". Feels great to relax.
|
*/

require ROOT . '/app/autoload.php';
require ROOT . '/app/dbloader.php';
