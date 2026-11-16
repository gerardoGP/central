<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


// Rutas protegidas por Passport (Client Credentials), validación de IP y Rate Limiting dinámico
Route::middleware(['client', \App\Http\Middleware\VerifyApiConsumerMiddleware::class, 'throttle:api-dynamic'])
    ->prefix('v1')
    ->group(function () {
        
        Route::get('/datos-centrales', function () {
            return response()->json([
                'success' => true,
                'data' => 'Aquí va la data consumida por el sistema externo.'
            ]);
        });

    });