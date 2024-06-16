<?php

use App\Controllers\AuthController;
use App\Controllers\FlightController;
use App\Models\Flight;

$router->get('/login', function () {
    $authController = new AuthController();
    $authController->login();
});

$router->post('/login', function () {
    $authController = new AuthController();
    $authController->login();
});

$router->get('/logout', [AuthController::class, 'logout']);

$router->get('/flights/{id}', function ($id) {
    $flightController = new FlightController(new Flight());
    $flightController->show($id);
});

$router->post('/flights', function () {
    $flightController = new FlightController(new Flight());
    $flightController->store($_POST);
});

$router->put('/flights/{id}', function ($id) {
    $flightController = new FlightController(new Flight());
    $flightController->update($id, $_POST);
});

$router->delete('/flights/{id}', function ($id) {
    $flightController = new FlightController(new Flight());
    $flightController->destroy($id);
});
