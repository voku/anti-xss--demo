<?php

/**
 * Database Config
 */

return [

    /*
  |--------------------------------------------------------------------------
  | Default Database Connection Name
  |--------------------------------------------------------------------------
  |
  | Here you may specify which of the database connections below you wish
  | to use as your default connection for all database work. Of course
  | you may use many connections at once using the Database library.
  |
     */

    'default' => 'mysql',

    /*
  |--------------------------------------------------------------------------
  | Database Connections
  |--------------------------------------------------------------------------
  |
  | Here are each of the database connections setup for your application.
  |
     */

    'connections' => [

        'mysql' => [
            'driver'   => 'mysql',
            'host'     => $_SERVER['DB_HOST'] ?? 'localhost',
            'database' => $_SERVER['DB_NAME'] ?? 'mysql_test',
            'username' => $_SERVER['DB_USER'] ?? 'root',
            'password' => $_SERVER['DB_PASS'] ?? '',
        ],

    ],

];
