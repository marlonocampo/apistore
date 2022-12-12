<?php

use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ProductoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::prefix('Categoria')->group(function () {
    Route::get('/Listar', [CategoriaController::class, 'Listar']);
    Route::get('/Crear', [CategoriaController::class, 'Crear']);
});

Route::prefix('Producto')->group(function () {
    Route::get('/Listar', [ProductoController::class, 'Listar']);
    Route::post('/Crear', [ProductoController::class, 'Insertar']);
    Route::put('/Actualizar', [ProductoController::class, 'Actualizar']);

});