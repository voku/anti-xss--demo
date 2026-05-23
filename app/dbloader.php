<?php

declare(strict_types=1);

final class DatabaseConnection
{
    public static function connect(array $config): void
    {
        $conn = $config['connections'][$config['default']];

        if ($conn['driver'] === 'mysql') {
            \voku\db\DB::getInstance(
                $conn['host'],
                $conn['username'],
                $conn['password'],
                $conn['database']
            );
        }
    }
}

DatabaseConnection::connect(require ROOT . '/app/config/database.php');
