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
        $query = "INSERT INTO customers (
            name,
            gender,
            date_of_birth,
            state,
            city,
            street,
            number,
            zip_code,
            email,
            telephone,
            document_number,
            document_type,
            status,
            comments,
            username,
            password
        )
        VALUES (
                :name,
                :gender,
                :date_of_birth,
                :state,
                :city,
                :street,
                :number,
                :zip_code,
                :email,
                :telephone,
                :document_number,
                :document_type,
                :status,
                :comments,
                :username,
                :password
            )";
        $result = $conn->prepare($query);

        $result->bindParam(':name', $data['name']);
        $result->bindParam(':gender', $data['gender']);
        $result->bindParam(':date_of_birth', $data['date_of_birth']);
        $result->bindParam(':state', $data['state']);
        $result->bindParam(':city', $data['city']);
        $result->bindParam(':street', $data['street']);
        $result->bindParam(':number', $data['number']);
        $result->bindParam(':zip_code', $data['zip_code']);
        $result->bindParam(':email', $data['email']);
        $result->bindParam(':telephone', $data['telephone']);
        $result->bindParam(':document_number', $data['document_number']);
        $result->bindParam(':document_type', $data['document_type']);
        $result->bindParam(':status', $data['status']);
        $result->bindParam(':comments', $data['comments']);
        $result->bindParam(':username', $data['username']);
        $result->bindParam(':password', $data['password']);

        $result->execute();
        return $conn->lastInsertId();
    }

    public static function update(int $id, array $data): int
    {
        $db = new Database();
        $conn = $db->getConnection();
        $query = "UPDATE customers
            SET
                name = :name,
                gender = :gender,
                date_of_birth = :date_of_birth,
                state = :state,
                city = :city,
                street = :street,
                number = :number,
                zip_code = :zip_code,
                email = :email,
                telephone = :telephone,
                document_number = :document_number,
                document_type = :document_type,
                status = :status,
                comments = :comments,
                username = :username,
                password = :password
            WHERE id = $id";
        $result = $conn->prepare($query);

        $result->bindParam(':name', $data['name']);
        $result->bindParam(':gender', $data['gender']);
        $result->bindParam(':date_of_birth', $data['date_of_birth']);
        $result->bindParam(':state', $data['state']);
        $result->bindParam(':city', $data['city']);
        $result->bindParam(':street', $data['street']);
        $result->bindParam(':number', $data['number']);
        $result->bindParam(':zip_code', $data['zip_code']);
        $result->bindParam(':email', $data['email']);
        $result->bindParam(':telephone', $data['telephone']);
        $result->bindParam(':document_number', $data['document_number']);
        $result->bindParam(':document_type', $data['document_type']);
        $result->bindParam(':status', $data['status']);
        $result->bindParam(':comments', $data['comments']);
        $result->bindParam(':username', $data['username']);
        $result->bindParam(':password', $data['password']);

        $result->execute();
        return $id;
    }

    public static function delete(int $id): int
    {
        $db = new Database();
        $conn = $db->getConnection();
        $query = "DELETE FROM customers WHERE id = $id";
        $result = $conn->prepare($query);
        $result->execute();
        return $id;
    }
}
