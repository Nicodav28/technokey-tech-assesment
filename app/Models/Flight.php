<?php

namespace App\Models;

use App\Helpers\DB;
use PDO;

class Flight
{
    private $db;

    public function __construct()
    {
        $this->db = DB::getInstance()->getConnection();
    }

    public function getFlights($filters = [], $sort = 'id', $order = 'ASC', $limit = 10, $offset = 0)
    {
        $query = 'SELECT * FROM flights WHERE 1=1';
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
        return $stmt->fetchAll();
    }

    public function getFlight($id)
    {
        $query = 'SELECT * FROM flights WHERE id = :id';
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch();
    }

    public function createFlight($data)
    {
        $query = 'INSERT INTO flights (date, type, cost) VALUES (:date, :type, :cost)';
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':date', $data['date']);
        $stmt->bindParam(':type', $data['type']);
        $stmt->bindParam(':cost', $data['cost']);
        return $stmt->execute();
    }

    public function updateFlight($id, $data)
    {
        $query = 'UPDATE flights SET date = :date, type = :type, cost = :cost WHERE id = :id';
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':date', $data['date']);
        $stmt->bindParam(':type', $data['type']);
        $stmt->bindParam(':cost', $data['cost']);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function deleteFlight($id)
    {
        $query = 'DELETE FROM flights WHERE id = :id';
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
