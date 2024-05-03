<?php

require_once __DIR__ . '/../app/Http/Middleware/Authenticate.php';
require_once __DIR__ . '/../Facades/Response.php';
class Route
{
    private static string $method;
    private static string $route;
    private static ?int $params;
    private static array $request;
    private static bool $found = false;

    public static function setDefinition(string $method, string $route, array $request): void
    {
        try {
            self::$method = $method;
            self::$route = $route;
            self::$params = null;
            self::$request = $request;
            if (substr_count($route, '/') > 1) {
                self::$params = substr($route, strpos($route, '/', 1) + 1);
                self::$route = substr($route, 0, strpos($route, '/', 1)) . '/{id}';
            }
            var_dump(self::$method, self::$route, self::$params);
        } catch (\Throwable $th) {
            
        }
    }
    private static function callController(string $path, array $action): void
    {
        if (self::$route == $path) {
            self::$found = true;
            self::$request['body'] = (array) self::$request['body'];
            $controller = new $action[0]();
            $method = $action[1];

            echo Authenticate::handle(self::$request, fn () => ($controller->$method(self::$request)));
        }
    }
    public static function get(string $path, array $action): void
    {
        if (self::$method == 'GET')
            self::callController($path, $action);
    }

    public static function post(string $path, array $action): void
    {
        if (self::$method == 'POST')
            self::callController($path, $action);
    }

    public static function put(string $path, array $action): void
    {
        if (self::$method == 'PUT')
            self::callController($path, $action);
    }

    public static function delete(string $path, array $action): void
    {
        if (self::$method == 'DELETE')
            self::callController($path, $action);
    }

    public static function fallback()
    {
        if (!self::$found)
            echo Response::json(404, 'Not Found');
    }
}
