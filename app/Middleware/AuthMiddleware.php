<?php

namespace App\Middleware;

class AuthMiddleware
{
    /**
     * Initializes a new session or resumes an existing one, then checks if the user is logged in by checking 'user_id' in the session.
     * If the user is not logged in, redirects to the login page.
     */
    public static function check()
    {
        session_start();
        if (!isset($_SESSION['user_id'])) {
            header('Location: login');
        }
    }
}
