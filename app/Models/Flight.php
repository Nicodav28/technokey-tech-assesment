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
}
