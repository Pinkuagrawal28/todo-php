<?php

namespace App\Query;

use App\Core\Database;
use PDO;

/***
   * This classes Handles BaseQueries for PDO
   */
abstract class BaseQuery
{
    protected PDO $db;

    /***
   * This is function initializes the pdo for the Base Query
   */
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
