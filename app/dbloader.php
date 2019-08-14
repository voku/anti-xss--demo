<?php

/**
 * Create a Database-Connection
 */
class DatabseConnection
{
    /**
     * @param array $config
     */
    public static function connect($config)
    {
        $conn = $config['connections'][$config['default']];

        switch ($conn['driver']) {
            case 'mysql':
                $db = \voku\db\DB::getInstance(
                    $conn['host'],
                    $conn['username'],
                    $conn['password'],
                    $conn['database']
                );

                break;
        }
    }
}

DatabseConnection::connect(require_once ROOT . '/app/config/database.php');
