<?php

namespace App\Middleware;

class SanitizeMiddleware
{
    /**
     * Cleanses the global GET and POST arrays from PHP's `$_GET` and `$_POST`
     * to prevent potential XSS by sanitizing the inputs as strings.
     * The global `$_REQUEST` array sanitization is commented out and therefore not active.
     */
    public static function handle()
    {
        $_GET = filter_input_array(INPUT_GET, FILTER_SANITIZE_STRING);
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        // $_REQUEST = filter_input_array(INPUT_REQUEST, FILTER_SANITIZE_STRING);
    }
}
