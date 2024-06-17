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

    /**
     * Retrieves a user record from the database by email.
     * @param {string} $email - The email address of the user to find.
     * @returns {array|null} Associative array of user data or null if not found.
     */
    public function find($email)
    {
        $stmt = $this->db->prepare('SELECT * FROM usuarios WHERE email = :email');
        $stmt->execute([':email' => $email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Creates a new user with hashed password and inserts it into the 'usuarios' table.
     * @param {object} $data - User data including 'nombre', 'email', and 'contrasena'.
     * @returns {boolean} - True if the insertion was successful, false otherwise.
     */
    public function create($data)
    {
        $hashedPassword = password_hash($data['contrasena'], PASSWORD_BCRYPT);
        $stmt = $this->db->prepare('INSERT INTO usuarios (nombre, email,contrasena) VALUES (:name, :email, :password)');
        return $stmt->execute([':name' => $data['nombre'], ':password' => $hashedPassword, ':email' => $data['email']]);
    }
}
