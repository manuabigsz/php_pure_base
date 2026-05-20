<?php

namespace App\Core;

use PDO;
use PDOException;

class Database
{
    private static ?PDO $connection = null;

    public static function connect(): PDO
    {
        if (self::$connection === null) {

            $config = require __DIR__ . '/../../config/database.php';

            try {

                self::$connection = new PDO(
                    "pgsql:host={$config['host']};port={$config['port']};dbname={$config['database']}",
                    $config['user'],
                    $config['password']
                );

                self::$connection->setAttribute(
                    PDO::ATTR_ERRMODE,
                    PDO::ERRMODE_EXCEPTION
                );

                self::$connection->setAttribute(
                    PDO::ATTR_DEFAULT_FETCH_MODE,
                    PDO::FETCH_ASSOC
                );

            } catch (PDOException $e) {

                die('Erro conexão: ' . $e->getMessage());
            }
        }

        return self::$connection;
    }
}