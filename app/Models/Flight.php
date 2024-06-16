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

    public function getFlights($filters = [], $sort = 'id', $order = 'ASC', $limit = 10, $offset = 0)
    {
        $query = 'SELECT * FROM vuelos WHERE 1=1';
        $params = [];

        if (!empty($filters['date'])) {
            $query .= ' AND date = :date';
            $params['date'] = $filters['date'];
        }

        if (!empty($filters['type'])) {
            $query .= ' AND type = :type';
            $params['type'] = $filters['type'];
        }

        $query .= " ORDER BY $sort $order LIMIT :limit OFFSET :offset";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);

        foreach ($params as $key => &$val) {
            $stmt->bindParam(':' . $key, $val);
        }

        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getFlight($id)
    {
        $query = 'SELECT * FROM vuelos WHERE id = :id';
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function createFlight($data)
    {
        $query = 'INSERT INTO vuelos (codigo_avion, fecha, hora, costo, destino, tipo) VALUES (:planeCode, :flightDate, :hour, :cost, :destination, :type)';
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':planeCode', $data['codigo_avion']);
        $stmt->bindParam(':flightDate', $data['fecha']);
        $stmt->bindParam(':hour', $data['hora']);
        $stmt->bindParam(':cost', $data['costo'], PDO::PARAM_STR);  // Forzando a que 'costo' se trate como una cadena para precisión decimal
        $stmt->bindParam(':destination', $data['destino']);
        $stmt->bindParam(':type', $data['tipo'], PDO::PARAM_INT);  // Forzando a que 'tipo' se trate como un entero

        return $stmt->execute();
    }


    public function updateFlight($id, $data)
    {
        $query = 'UPDATE vuelos SET date = :date, type = :type, cost = :cost WHERE id = :id';
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':date', $data['date']);
        $stmt->bindParam(':type', $data['type']);
        $stmt->bindParam(':cost', $data['cost']);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function deleteFlight($id)
    {
        $query = 'DELETE FROM vuelos WHERE id = :id';
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
