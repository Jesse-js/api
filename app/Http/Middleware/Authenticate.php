<?php 

require_once __DIR__ . '/../../../env.php';

class Authenticate
{
    public static function handle(array $request, Closure $next)
    {
        if(!isset($request['authorization_token'])) {
            return 'Sem token!';
        }

        if ($request['authorization_token'] !== AUTHORIZATION_TOKEN) {
            return 'Não autorizado!';
        }
        
        return $next($request);
    }
}