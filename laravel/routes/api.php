<?php

use App\Http\Controllers\v1\CategoriaController;
use App\Http\Controllers\v1\ProductoController;
use App\Http\Controllers\v1\SeguridadController;
use App\Http\Controllers\v1\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:api')->group(function(){
    Route::get('/productos', [ProductoController::class, 'obtenerLista']);
    Route::get('/productos/{id}', [ProductoController::class, 'obtenerItem']);
    Route::post('/productos', [ProductoController::class, 'store']);
    Route::put('/productos', [ProductoController::class, 'update']);
    Route::patch('/productos', [ProductoController::class, 'patch']);
    Route::delete('/productos/{id}', [ProductoController::class, 'delete']);
    
    Route::get('/categorias', [CategoriaController::class, 'obtenerLista']);
    Route::get('/categorias/{id}', [CategoriaController::class, 'obtenerItem']);
    Route::post('/categorias', [CategoriaController::class, 'store']);
    Route::put('/categorias', [CategoriaController::class, 'update']);
    Route::patch('/categorias', [CategoriaController::class, 'patch']);
    Route::delete('/categorias/{id}', [CategoriaController::class, 'delete']);
    
    Route::post('/users', [UserController::class, 'store']);
    
});
Route::post('/seguridad/login', [SeguridadController::class, 'login']);
