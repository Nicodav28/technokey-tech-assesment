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

$router->get('/logout', function () {
    $authController = new AuthController();
    $authController->logout();
});

$router->get('/register', function () {
    $authController = new AuthController();
    $authController->register($_POST);
});

$router->post('/register', function () {
    $authController = new AuthController();
    $authController->register($_POST);
});

$router->get('/', function () {
    $flightController = new FlightController(new Flight());
    $flightController->index();
});


$router->get('/{id}', function ($id) {
    $flightController = new FlightController(new Flight());
    $flightController->show($id);
});

$router->post('/', function () {
    $flightController = new FlightController(new Flight());
    $flightController->store($_POST);
});

$router->put('/{id}', function ($id) {
    $flightController = new FlightController(new Flight());
    $flightController->update($id, $_POST);
});

$router->delete('/{id}', function ($id) {
    $flightController = new FlightController(new Flight());
    $flightController->destroy($id);
});
