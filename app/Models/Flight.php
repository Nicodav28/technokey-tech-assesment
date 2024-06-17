<?php

namespace App\Models;

use App\Helpers\DB;
use PDO;

class Flight
{
    private $db;

    public function __construct()
    {
        $this->db = DB::getInstance();
    }

    /**
     * Retrieves a list of flights from the database with optional filtering, sorting, and pagination.
     *
     * @param array $filters Associative array of filter conditions like 'date' and 'type'.
     * @param string $sort The column by which to sort the results.
     * @param string $order The direction of the sort, either 'ASC' or 'DESC'.
     * @param int $limit The maximum number of results to return.
     * @param int $offset The number of results to skip (for pagination).
     * @return array Returns an array of associative arrays where each sub-array represents a flight.
     */
    public function getFlights($filters, $sort, $order, $limit, $offset)
    {
        $query = "SELECT * FROM vuelos WHERE 1=1";

        if (!empty($filters['date'])) {
            $query .= " AND fecha = :date";
        }
        if (!empty($filters['type'])) {
            $query .= " AND tipo = :type";
        }

        $query .= " ORDER BY " . $sort . " " . $order;
        $query .= " LIMIT :limit OFFSET :offset";

        $stmt = $this->db->prepare($query);

        if (!empty($filters['date'])) {
            $stmt->bindParam(':date', $filters['date']);
        }
        if (!empty($filters['type'])) {
            $stmt->bindParam(':type', $filters['type']);
        }

        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Retrieves a flight record by its unique identifier.
     *
     * Executes a SELECT query on the 'vuelos' table to find a specific flight using the provided id.
     * Utilizes prepared statements to prevent SQL injection. The result is fetched as an associative array.
     *
     * @param {number} $id - The unique identifier of the flight to be retrieved.
     * @returns {Array|false} The associative array of flight data or false if no record is found.
     */
    public function getFlight($id)
    {
        $query = 'SELECT * FROM vuelos WHERE id = :id';
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Creates a new flight record in the database.
     * @param {Object} $data - An object with flight details including plane code, flight date, hour, cost, destination, and type.
     * @returns {boolean} - Returns true if the record was successfully inserted, false otherwise.
     */
    public function createFlight($data)
    {
        $query = 'INSERT INTO vuelos (codigo_avion, fecha, hora, costo, destino, tipo) VALUES (:planeCode, :flightDate, :hour, :cost, :destination, :type)';
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':planeCode', $data['codigo_avion']);
        $stmt->bindParam(':flightDate', $data['fecha']);
        $stmt->bindParam(':hour', $data['hora']);
        $stmt->bindParam(':cost', $data['costo'], PDO::PARAM_STR);
        $stmt->bindParam(':destination', $data['destino']);
        $stmt->bindParam(':type', $data['tipo'], PDO::PARAM_INT);

        return $stmt->execute();
    }


    /**
     * Updates the flight details in the database with the provided data.
     * @param {string} id - The unique identifier for the flight to update.
     * @param {object} data - An object containing the flight details to update.
     * @returns {boolean} - Returns true if the update was successful, false otherwise.
     */
    public function updateFlight($id, $data)
    {
        $query = 'UPDATE vuelos SET codigo_avion = :planeCode, fecha = :flightDate, hora = :hour, costo = :cost, destino = :destination, tipo = :type WHERE id = :id';
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':planeCode', $data['codigo_avion']);
        $stmt->bindParam(':flightDate', $data['fecha']);
        $stmt->bindParam(':hour', $data['hora']);
        $stmt->bindParam(':cost', $data['costo'], PDO::PARAM_STR);
        $stmt->bindParam(':destination', $data['destino']);
        $stmt->bindParam(':type', $data['tipo'], PDO::PARAM_INT);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        return $stmt->execute();
    }

    /**
     * Deletes a flight from the database based on the given ID.
     * @param {number} $id - The unique identifier of the flight to delete.
     * @returns {boolean} - Returns true if the flight was successfully deleted, false otherwise.
     */
    public function deleteFlight($id)
    {
        $query = 'DELETE FROM vuelos WHERE id = :id';
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    /**
     * Counts the total number of flights based on provided filters.
     *
     * @param {Object} $filters - An object containing filter conditions such as date and type.
     * @returns {number} - The total count of flights matching the criteria.
     */
    public function countTotalFlights($filters)
    {
        $conditions = [];
        $params = [];

        $query = 'SELECT COUNT(*) AS total FROM vuelos';

        if (!empty($filters['date'])) {
            $conditions[] = 'fecha = :fecha';
            $params[':fecha'] = $filters['date'];
        }

        if (!empty($filters['type'])) {
            $conditions[] = 'tipo = :tipo';
            $params[':tipo'] = $filters['type'];
        }

        if (!empty($conditions)) {
            $query .= ' WHERE ' . implode(' AND ', $conditions);
        }

        $stmt = $this->db->prepare($query);
        $stmt->execute($params);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result['total'];
    }
}
