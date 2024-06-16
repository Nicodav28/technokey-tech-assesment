<?php

namespace App\Controllers;

use App\Models\User;
use App\Helpers\View;

class AuthController
{
    public function __construct()
    {
        session_start();
    }

    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userModel = new User();
            $userData = $userModel->find($_POST['email']);

            if ($userData && password_verify($_POST['password'], $userData['contrasena'])) {
                $_SESSION['user_id'] = $userData['email'];
                header('Location: ' . APP_URL);
                exit;
            } else {
                $error = 'Invalid credentials';
                View::render('login', ['error' => $error]);
                exit;
            }
        } else {
            View::render('login');
        }
    }

    public function logout()
    {
        session_destroy();
        header('Location: /login');
        exit;
    }

    public function register($params)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (empty($params)) {
                session_destroy();
                header('Location: /login');
                exit;
            }

            $userModel = new User();

            $data = [
                'nombre' => $params['name'],
                'email' => $params['email'],
                'contrasena' => $params['password'],
            ];

            $userModel->create($data);

            View::render('login');
        } else {
            View::render('register');
        }
    }
}
