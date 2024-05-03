<?php

require_once __DIR__ . '/../../Facades/Migration.php';

class CreateCustomersTable extends Migration
{
    public function up(): void
    {
        $sql = "CREATE TABLE IF NOT EXISTS `customers` (
            `id` int(11) NOT NULL AUTO_INCREMENT,
            `name` varchar(200) NOT NULL,
            `gender` CHAR(1) NOT NULL DEFAULT 'N',
            `date_of_birth` DATE NOT NULL,
            `state` varchar(50) NOT NULL,
            `city` varchar(100) NOT NULL,
            `street` varchar(150) NOT NULL,
            `number` varchar(10) NOT NULL,
            `zip_code` varchar(8) NOT NULL,
            `email` varchar(150) NOT NULL UNIQUE,
            `telephone` varchar(20) NOT NULL,
            `document_number` varchar(20) NOT NULL UNIQUE,
            `document_type` varchar(4) NOT NULL DEFAULT 'cpf',
            `status` tinyint(1) NOT NULL DEFAULT '1',
            `comments` text NULL,
            `username` varchar(15) NOT NULL UNIQUE,
            `password` varchar(20) NOT NULL,
            `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
            `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            PRIMARY KEY (`id`)
        )";

        $this->conn->exec($sql);
    }

    public function down(): void
    {
        $this->conn->exec("DROP TABLE IF EXISTS `customers`");
    }
}
