<?php

require_once __DIR__ . '/../app/Http/Middleware/Authenticate.php';
require_once __DIR__ . '/../Facades/Response.php';
class Route
{
    private static string $method;
    private static string $route;
    private static ?int $param;
    private static array $request;
    private static bool $found = false;

    public static function setDefinition(
        string $method,
        string $route,
        array $request
    ): void {
        try {
            self::$method = $method;
            self::$route = $route;
            self::$param = null;
            self::$request = $request;

            if (substr_count($route, '/') > 1) {
                self::$param = substr($route, strpos($route, '/', 1) + 1);
                self::$route = substr($route, 0, strpos($route, '/', 1)) . '/{id}';
            }
        } catch (\Throwable $th) {
        }
    }
    private static function callController(string $path, array $action): string
    {
        if (self::$route == $path) {
            self::$found = true;
            self::$request['body'] = (array) self::$request['body'];
            $controller = new $action[0]();
            $method = $action[1];

            if (isset(self::$param)) {
                return Authenticate::handle(
                    self::$request,
                    fn () => ($controller->$method(self::$param, self::$request))
                );
            }

            return Authenticate::handle(
                self::$request,
                fn () => ($controller->$method(self::$request))
            );
        }
    }
    public static function get(string $path, array $action): void
    {
        if (self::$method == 'GET')
            echo self::callController($path, $action);
    }

    public static function post(string $path, array $action): void
    {
        if (self::$method == 'POST')
            echo self::callController($path, $action);
    }

    public static function put(string $path, array $action): void
    {
        if (self::$method == 'PUT')
            echo self::callController($path, $action);
    }

    public static function delete(string $path, array $action): void
    {
        if (self::$method == 'DELETE')
            echo self::callController($path, $action);
    }

    public static function fallback()
    {
        if (!self::$found)
            echo Response::json(404, 'Not Found');
    }
}
