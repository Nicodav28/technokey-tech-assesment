<?php

use App\Controllers\AuthController;
use App\Controllers\FlightController;
use App\Models\Flight;

$router->get('/login', [AuthController::class, 'login']);
$router->post('/login', [AuthController::class, 'login']);
$router->get('/logout', [AuthController::class, 'logout']);
$router->get('/', function () {
    $flightController = new FlightController(new Flight());
    $flightController->index();
});
