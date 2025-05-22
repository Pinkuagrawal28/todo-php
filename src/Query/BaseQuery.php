<?php

namespace App\Query;

use App\Core\Database;
use PDO;

abstract class BaseQuery
{
    protected PDO $db;

    public function __construct()
    {
        $this->db = DataBase::pdo();
    }

    // Basic example: fetch all records from a table
    protected function getAll(string $table): array
    {
        $stmt = $this->db->query("SELECT * FROM {$table}");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // You can add more shared methods here (e.g., find, insert, update, cache, etc.)
}
