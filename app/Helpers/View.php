<?php

namespace App\Helpers;

class View
{
    /**
     * Render a specific view with optional data.
     *
     * This method chooses a specific layout for all views except 'login' and 'register'.
     * For 'login' and 'register', it directly includes the respective view file.
     *
     * @param string $view The name of the view file to render without the '.php' extension.
     * @param array $data Optional associative array of data to be extracted and made available in the view.
     */
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
