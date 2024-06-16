<?php

namespace App\Models;

use App\Helpers\DB;
use PDO;

class User
{
    private $db;

    public function __construct()
    {
        $this->db = DB::getInstance();
    }

    public function find($email)
    {
        $stmt = $this->db->prepare('SELECT * FROM usuarios WHERE email = :email');
        $stmt->execute([':email' => $email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($data)
    {
        $hashedPassword = password_hash($data['contrasena'], PASSWORD_BCRYPT);
        $stmt = $this->db->prepare('INSERT INTO usuarios (nombre, email,contrasena) VALUES (:name, :email, :password)');
        return $stmt->execute([':name' => $data['nombre'], ':password' => $hashedPassword, ':email' => $data['email']]);
    }
}
