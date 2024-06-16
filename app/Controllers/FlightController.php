<?php

namespace App\Controllers;

use App\Models\Flight;
use App\Helpers\View;
use App\Middleware\AuthMiddleware;
use App\Utils\General;

class FlightController
{
    protected Flight $flight;

    public function __construct(Flight $flight)
    {
        AuthMiddleware::check();
        $this->flight = $flight;
    }

    public function index()
    {
        $filters = [
            'date' => $_GET['date'] ?? null,
            'type' => $_GET['type'] ?? null,
        ];

        $sort = $_GET['sort'] ?? 'id';
        $order = $_GET['order'] ?? 'ASC';
        $limit = 10;
        $page = $_GET['page'] ?? 1;
        $offset = ($page - 1) * $limit;

        $flights = $this->flight->getFlights($filters, $sort, $order, $limit, $offset);
        View::render('flights', ['flights' => $flights, 'limit' => $limit]);
    }

    public function show($id)
    {
        $flight = $this->flight->getFlight($id);
        View::render('flights', ['flight' => $flight]);
    }

    public function store(array $params)
    {
        if (!General::validateEmptyFields($params)) {
            View::render('flights', ['error' => "All fields are required to create a new flight record."]);
            return;
        }

        $data = [
            'codigo_avion' => $params['planeCode'],
            'fecha' => (string) $params['flightDate'],
            'hora' => $params['hour'],
            'costo' => (float)$params['cost'],  // Asegurándose de que 'costo' sea un float
            'destino' => $params['destination'],
            'tipo' => (int)$params['type'],  // Asegurándose de que 'tipo' sea un entero
        ];

        $result = $this->flight->createFlight($data);

        View::render('flights', ['flight' => $result]);
    }


    public function update($id, $params)
    {
        if (!General::validateEmptyFields($params)) {
            View::render('flights', ['error' => "All fields are required to create a new flight record."]);
        }

        $data = [
            'date' => $params['date'],
            'type' => $params['type'],
            'cost' => $params['cost'],
        ];

        $result = $this->flight->updateFlight($id, $data);

        // TODO: Redirigir y/o mostrar mensajes de resultado
        View::render('flights', ['flight' => $result]);
    }

    public function destroy($id)
    {
        $result = $this->flight->deleteFlight($id);

        // TODO: Redirigir y/o mostrar mensajes de resultado
        View::render('flights', ['flight' => $result]);
    }
}
