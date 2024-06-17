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

    /**
     * Attempts to log the user in using POST data.
     *
     * Checks for POST request and validates the provided email and password.
     * If valid, redirects to the application URL. If authentication fails,
     * passes an error message to the view, which renders the login page.
     * If the request method is not POST, simply renders the login page.
     */
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

    /**
     * Logs the user out by destroying the session, then redirects to the login page.
     */
    public function logout()
    {
        session_destroy();
        header('Location: /login');
        exit;
    }

    /**
     * Handles the user registration process.
     * If the request method is POST, it validates the submitted parameters and registers a new user.
     * For an empty parameter set, it destroys the session and redirects to the login page.
     * On successful registration, the user is directed to the login page.
     * If the request is not POST, it renders the registration view.
     *
     * @param {Object} $info Contains registration input fields such as name, email, and password.
     */
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
