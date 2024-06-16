<?php
require_once __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

$router = new \Bramus\Router\Router();

require __DIR__ . '/../routes/web.php';

$router->run();
