<?php 

require_once './Facades/Route.php';
require_once './app/Http/Controllers/ClienteController.php';

switch ($method) {
    case 'GET':
        Route::get('/clientes', $request, [ClienteController::class, 'index']);
        break;
    case 'POST':
        Route::post('/clientes', $request, [ClienteController::class, 'store']);
        break;
    case 'PUT':
        Route::put('/clientes', $request, [ClienteController::class, 'update']);
        break;
    case 'DELETE':
        Route::delete('/clientes', $request, [ClienteController::class, 'destroy']);
        break;
    default:
        Route::handleError($request);
        break;
}
