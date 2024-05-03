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
}