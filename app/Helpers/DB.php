<?php

namespace App\Helpers;

use Exception;
use PDO;
use PDOException;
use PDOStatement;

class DB
{
    private static $instance = null;
    private $connection;

    private function __construct()
    {
        $dsn = "pgsql:host=localhost;port=5432;dbname=technokey_asses";
        $username = 'postgres';
        $password = '0000';

        try {
            $this->connection = new PDO($dsn, $username, $password);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            print_r('Database connection failed: ' . $e->getMessage());
            die();
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

    public function prepare(string $sql): PDOStatement
    {
        return $this->connection->prepare($sql);
    }
}
