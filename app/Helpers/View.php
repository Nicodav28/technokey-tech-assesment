<?php

namespace App\Helpers;

class View
{
    public static function render($view, $data = [])
    {
        if ($view != 'login' && $view != 'register') {
            $data['view'] = $view;
            extract($data);
            include_once __DIR__ . '/../Views/layouts/layout.php';
        } else {
            extract($data);
            include_once __DIR__ . '/../Views/' .  $view . '.php';
        }
    }
}
