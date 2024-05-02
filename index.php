<?php

header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, DELETE, PUT");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$method = $_SERVER['REQUEST_METHOD'];
$route = trim('/' . $_GET['path']); //[explode('/', trim($_GET['path'], '/'))];
$request = [
    'uri' => $route,
    'body' => json_decode(file_get_contents('php://input'))
];

require_once './routes/api.php';
