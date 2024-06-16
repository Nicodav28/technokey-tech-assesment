<?php

namespace App\Helpers;

use PDO;
use PDOException;

class DB
{
    private static $instance = null;
    private $connection;

    private function __construct()
    {
        $config = include_once __DIR__ . '/../../config/database.php';

        $dsn = "pgsql:host={$config['host']};port={$config['port']};dbname={$config['database']};";
        try {
            $this->connection = new PDO($dsn, $config['username'], $config['password']);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die('Database connection failed: ' . $e->getMessage());
        }
    }

    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new DB();
        }
        return self::$instance;
    }

    public function getConnection()
    {
        return $this->connection;
    }
}
