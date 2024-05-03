<?php 

require_once __DIR__ . '/../../config/database.php';

class Customer
{
    public static function all(): array
    {
        $db = new Database();
        $conn = $db->getConnection();
        $query = "SELECT * FROM customers";
        $result =   $conn->prepare($query);
        $result->execute();
        $result = $result->fetchAll(PDO::FETCH_ASSOC);
        
        return $result;   
    }

    public static function find(int $id): array
    {
        $db = new Database();
        $conn = $db->getConnection();
        $query = "SELECT * FROM customers WHERE id = $id";
        $result =   $conn->prepare($query);
        $result->execute();
        $result = $result->fetchAll(PDO::FETCH_ASSOC);
        
        return $result;   
    }

    public static function create(array $data): int
    {
        $db = new Database();
        $conn = $db->getConnection();
        $query = "INSERT INTO customers (name, email, phone) VALUES (:name, :email, :phone)";
        $result =   $conn->prepare($query);
        $result->bindParam(':name', $data['name']);
        $result->bindParam(':email', $data['email']);
        $result->bindParam(':phone', $data['phone']);
        $result->execute();
        return $conn->lastInsertId();
    }

    public static function update(int $id, array $data): int
    {
        $db = new Database();
        $conn = $db->getConnection();
        $query = "UPDATE customers SET name = :name, email = :email, phone = :phone WHERE id = $id";
        $result =   $conn->prepare($query);
        $result->bindParam(':name', $data['name']);
        $result->bindParam(':email', $data['email']);
        $result->bindParam(':phone', $data['phone']);
        $result->execute();
        return $conn->lastInsertId();
    }

    public static function delete(int $id): int
    {
        $db = new Database();
        $conn = $db->getConnection();
        $query = "DELETE FROM customers WHERE id = $id";
        $result = $conn->prepare($query);
        $result->execute();
        return $conn->lastInsertId();
    }
}