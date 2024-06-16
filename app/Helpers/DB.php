<?php

namespace App\Helpers;

use PDO;
use PDOException;
use PDOStatement;

class DB
{
    private static $instance = null;
    private $connection;

    private function __construct()
    {
        $config = include __DIR__ . '/../../config/database.php';

        $dsn = "pgsql:host={$config['host']};port={$config['port']};dbname={$config['database']};";

        try {
            $this->connection = new PDO($dsn, $config['username'], $config['password']);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->connection->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        } catch (PDOException $e) {
            die('Database connection failed: ' . $e->getMessage());
        }
    }

    public static function getInstance(): self
    {
        if (!self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function getConnection(): PDO
    {
        return $this->connection;
    }

    // Método opcional para ejecutar consultas preparadas
    public function prepare(string $sql): PDOStatement
    {
        return $this->connection->prepare($sql);
    }
}
