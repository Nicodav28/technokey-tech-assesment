<?php

namespace App\Models;

use App\Helpers\DB;

class User
{
    private $db;

    public function __construct()
    {
        $this->db = DB::getInstance()->getConnection();
    }

    public function find($username)
    {
        $stmt = $this->db->prepare('SELECT * FROM users WHERE username = :username');
        $stmt->execute(['username' => $username]);
        return $stmt->fetch();
    }

    public function create($username, $password)
    {
        $stmt = $this->db->prepare('INSERT INTO users (username, password) VALUES (:username, :password)');
        return $stmt->execute(['username' => $username, 'password' => password_hash($password, PASSWORD_BCRYPT)]);
    }
}
