<?php

namespace App\Controllers;

use App\Models\User;
use App\Helpers\View;

class AuthController
{
    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $user = new User();
            $userData = $user->find($_POST['username']);
            if ($userData && password_verify($_POST['password'], $userData['password'])) {
                session_start();
                $_SESSION['user_id'] = $userData['id'];
                header('Location: /flights');
            } else {
                $error = 'Invalid credentials';
                View::render('login', ['error' => $error]);
            }
        } else {
            View::render('login');
        }
    }

    public function logout()
    {
        session_start();
        session_destroy();
        header('Location: /login');
    }
}
