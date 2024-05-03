<?php 

require_once __DIR__ . '/../../../env.php';
require_once __DIR__ . '/../../../Facades/Response.php';

class Authenticate
{
    public static function handle(array $request, Closure $next)
    {
        $message = ['The authorization token is missing or is invalid!'];
        if(!isset($request['authorization_token'])) 
            return Response::json(401, 'Unauthorized', $message);

        if ($request['authorization_token'] !== AUTHORIZATION_TOKEN) 
            return Response::json(401, 'Unauthorized', $message);
        
        return $next($request);
    }
}