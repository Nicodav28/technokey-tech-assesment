<?php

namespace App\Controllers;

use App\Models\Flight;
use App\Helpers\View;
use App\Middleware\AuthMiddleware;

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
        View::render('flights', ['flights' => $flights]);
    }

    public function show($id)
    {
        $flight = $this->flight->getFlight($id);

        // TODO: Redirigir y/o mostrar mensajes de resultado
        View::render('flight', ['flight' => $flight]);
    }

    public function store(array $params)
    {
        $data = [
            'date' => $params['date'],
            'type' => $params['type'],
            'cost' => $params['cost'],
        ];

        $result = $this->flight->createFlight($data);

        // TODO: Redirigir y/o mostrar mensajes de resultado
        View::render('flight', ['flight' => $result]);
    }

    public function update($id, $params)
    {
        $data = [
            'date' => $params['date'],
            'type' => $params['type'],
            'cost' => $params['cost'],
        ];

        $result = $this->flight->updateFlight($id, $data);

        // TODO: Redirigir y/o mostrar mensajes de resultado
        View::render('flight', ['flight' => $result]);
    }

    public function destroy($id)
    {
        $result = $this->flight->deleteFlight($id);

        // TODO: Redirigir y/o mostrar mensajes de resultado
        View::render('flight', ['flight' => $result]);
    }
}
