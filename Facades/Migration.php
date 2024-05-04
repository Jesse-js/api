<?php

require_once __DIR__ . '/../config/database.php';

class Migration
{
    protected $db;
    protected $conn;
    public function __construct()
    {
        $this->db = new Database();
        $this->conn = $this->db->createDatabase();
        $this->conn = $this->db->getConnection();
    }
}
