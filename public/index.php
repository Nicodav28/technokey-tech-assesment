<?php
error_reporting(E_ALL ^ E_DEPRECATED);

require_once '../vendor/autoload.php';

use App\Middleware\SanitizeMiddleware;

$dotenv = Dotenv\Dotenv::createImmutable('../');
$dotenv->load();

SanitizeMiddleware::handle();

$router = new \Bramus\Router\Router();

require_once '../routes/web.php';

const APP_URL = 'http://localhost:/';

$router->run();
