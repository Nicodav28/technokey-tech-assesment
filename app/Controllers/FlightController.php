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

    /**
     * Display the index page with a list of flights.
     * Allows for filtering by date and type.
     * Supports sorting and pagination.
     */
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

        $totalFlights = $this->flight->countTotalFlights($filters);

        $totalPages = ceil($totalFlights / $limit);

        View::render('flights', [
            'flights' => $flights,
            'limit' => $limit,
            'sort' => $sort,
            'order' => $order,
            'currentPage' => $page,
            'totalPages' => $totalPages,
        ]);
    }

    /**
     * Displays the flight details as JSON based on the passed ID.
     * If no ID is passed, it sends a JSON response with an error message.
     *
     * @param {*} $id - The id of the flight to retrieve.
     */
    public function show($id)
    {

        if (!$id) {
            echo json_encode(['success' => false, 'message' => 'Id is a mandatory field.']);
        }

        $result = $this->flight->getFlight((int) $id);

        header('Content-Type: application/json');
        echo json_encode($result);
    }

    /**
     * Store a new flight record based on provided parameters.
     *
     * Validates the input fields before creating a flight. If validation fails,
     * renders the flights view with an error message. On successful creation,
     * redirects to the homepage.
     *
     * @param {array} $params - The parameters for the new flight, including plane code, flight date, hour, cost, destination, and type.
     */
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
            'costo' => (float)$params['cost'],
            'destino' => $params['destination'],
            'tipo' => (int)$params['type'],
        ];

        $this->flight->createFlight($data);

        header('location: /');
    }


    /**
     * Updates the flight information based on the provided ID and JSON input.
     * Validates the input fields before attempting to update the flight data.
     * Responds with a JSON encoded success status and a relevant message.
     *
     * @param {string} $id The ID of the flight to be updated.
     */
    public function update($id)
    {
        $json = file_get_contents('php://input');

        $params = json_decode($json, true);

        if (!General::validateEmptyFields($params)) {
            echo json_encode(['success' => false, 'message' => 'Failed to update flight.']);
        }

        $data = [
            'codigo_avion' => $params['planeCode'],
            'fecha' => $params['flightDate'],
            'hora' => $params['hour'],
            'tipo' => $params['type'],
            'costo' => $params['cost'],
            'destino' => $params['destination'],
        ];

        $result = $this->flight->updateFlight($id, $data);

        if ($result) {
            echo json_encode(['success' => true, 'message' => 'Flight updated successfully.']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to update flight.']);
        }
    }

    /**
     * Destroys a flight record based on the given ID.
     * Responds with a JSON-encoded success or failure message.
     *
     * @param {number} $id - The unique identifier of the flight to be deleted
     */
    public function destroy($id)
    {
        $result = $this->flight->deleteFlight($id);

        if ($result) {
            echo json_encode(['success' => true, 'message' => 'Flight deleted successfully.']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to delete flight.']);
        }
    }
}
