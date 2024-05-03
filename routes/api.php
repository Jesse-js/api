<?php 

require_once __DIR__ . '/../Facades/Route.php';
require_once __DIR__ . '/../app/Http/Controllers/CustomerController.php';

switch ($method) {
    case 'GET':
        Route::get('/customers', $request, [CustomerController::class, 'index']);
        break;
    case 'POST':
        Route::post('/customers', $request, [CustomerController::class, 'store']);
        break;
    case 'PUT':
        Route::put('/customers', $request, [CustomerController::class, 'update']);
        break;
    case 'DELETE':
        Route::delete('/customers', $request, [CustomerController::class, 'destroy']);
        break;
    default:
        Route::handleError($request);
        break;
}
