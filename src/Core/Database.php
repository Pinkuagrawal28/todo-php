<?php

namespace App\Core;

use PDO;
use PDOException;
use Exception;

/***
   * This classes Handles Database Connection
   */
class Database
{
    private static ?PDO $pdo = null;

    /***
   * This is function connects with the db via PDO
   */
    public static function pdo(): PDO
    {
        if (self::$pdo) {
            return self::$pdo;
        }

        $config = require BASE_PATH . '/config/dbh.config.php';

        try {
            $dsn = "mysql:host={$config['host']};dbname={$config['db_name']};port={$config['port']};charset={$config['charset']}";
            self::$pdo = new PDO($dsn, $config['user'], $config['pass'], [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            ]);
        } catch (PDOException $e) {
            die('Database connection failed: ' . $e->getMessage());
        }

        return self::$pdo;
    }
}
