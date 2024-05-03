<?php

require_once __DIR__ . '/../env.php';
class Database
{
    private string $host = DB_HOST;
    private string $db_name = DB_NAME;
    private string $username = DB_USER;
    private string $password = DB_PASSWORD;
    public  ?PDO $conn;

    public function getConnection(): ?PDO
    {
        $this->conn = null;

        try {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->exec("set names utf8");
        } catch (PDOException $exception) {
            echo "Erro de conexão: " . $exception->getMessage();
            $this->conn = null;
        }

        return $this->conn;
    }
}
