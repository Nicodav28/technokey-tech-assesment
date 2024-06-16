<?php

use App\Controllers\AuthController;
use App\Controllers\FlightController;

$router->get('/login', [AuthController::class, 'login']);
$router->post('/login', [AuthController::class, 'login']);
$router->get('/logout', [AuthController::class, 'logout']);
$router->get('/flights', [FlightController::class, 'index']);
