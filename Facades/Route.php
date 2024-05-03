<?php

require_once __DIR__ . '/../app/Http/Middleware/Authenticate.php';
class Route
{
    private static function callController(string $path, array $request, array $action): void
    {
        if ($path == $request['uri']) {
            $controller = new $action[0]();
            $method = $action[1];
            
            echo Authenticate::handle($request, fn () => ($controller->$method($request)));
        }
    }
    public static function get(string $path, array $request, array $action): void
    {
        self::callController($path, $request, $action);
    }

    public static function post(string $path, array $request, array $action): void
    {
        self::callController($path, $request, $action);
    }

    public static function put(string $path, array $request, array $action): void
    {
        self::callController($path, $request, $action);
    }

    public static function delete(string $path, array $request, array $action): void
    {
        self::callController($path, $request, $action);
    }

    public static function handleError($request)
    {
      echo json_encode(array("message" => "Error: method not handled"));
    }
    
}
