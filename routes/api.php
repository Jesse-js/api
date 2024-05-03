<?php

require_once __DIR__ . '/../Facades/Route.php';
require_once __DIR__ . '/../app/Http/Controllers/CustomerController.php';

Route::setDefinition($method, $route, $request);


Route::get('/customers', [CustomerController::class, 'index']);
Route::get('/customers/{id}', [CustomerController::class, 'find']);
Route::post('/customers', [CustomerController::class, 'store']);
Route::put('/customers/{id}', [CustomerController::class, 'update']);
Route::delete('/customers/{id}', [CustomerController::class, 'destroy']);

Route::fallback();
