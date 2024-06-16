<?php

namespace App\Middleware;

class SanitizeMiddleware
{
    public static function handle()
    {
        $_GET = filter_input_array(INPUT_GET, FILTER_SANITIZE_STRING);
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        // $_REQUEST = filter_input_array(INPUT_REQUEST, FILTER_SANITIZE_STRING);
    }
}
