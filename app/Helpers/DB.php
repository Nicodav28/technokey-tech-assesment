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
        $config = include __DIR__ . '/../../config/database.php';

        $dsn = "{$config['driver']}:host={$config['host']};port={$config['port']};dbname={$config['database']}";
        $username = $config['username'];
        $password = $config['password'];

        try {
            $this->connection = new PDO($dsn, $username, $password);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            print_r('Database connection failed: ' . $e->getMessage());
            die();
        }
    }

    /**
     * Returns the singleton instance of the class.
     *
     * If the instance does not already exist, it is created.
     * @return self An instance of the current class.
     */
    public static function getInstance(): self
    {
        if (!self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }


    /**
     * Prepares an SQL statement for execution and returns the statement object.
     * @param {string} $sql The SQL query to prepare.
     * @return {PDOStatement} The prepared statement.
     */
    public function prepare(string $sql): PDOStatement
    {
        return $this->connection->prepare($sql);
    }
}
