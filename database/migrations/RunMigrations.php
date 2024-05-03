<?php 

require_once __DIR__ . '/2024_05_02_2203_create_customers_table.php';

class RunMigrations
{
    public function run()
    {
        (new CreateCustomersTable())->up();
    }
}

(new RunMigrations())->run(); 