<?php

namespace App\Helpers;

class View
{
    public static function render($view, $data = [])
    {
        print_r("sdas");
        extract($data);
        include_once __DIR__ . '/../Views/' . $view . '.php';
    }
}
