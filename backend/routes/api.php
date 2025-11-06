<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Product\ProductController;
use App\Http\Controllers\PropertyController;

// Rota de teste
Route::get('/hello', function () {
    return response()->json(['message' => 'Olá do Laravel!']);
});


Route::prefix('auth')->group(function () {
    Route::post('/register', [AuthController::class, 'register']);
});

// ⭐ ROTAS DE PRODUTOS - Usando Controller
Route::prefix('products')->group(function () {
    // GET /api/products - Listar todos
    Route::get('/', [ProductController::class, 'index']);
    
    // GET /api/products/category/{category} - Por categoria (antes do {id})
    Route::get('/category/{category}', [ProductController::class, 'byCategory']);
    
    // GET /api/products/{id} - Buscar por ID
    Route::get('/{id}', [ProductController::class, 'show']);
    
    // POST /api/products - Criar
    Route::post('/', [ProductController::class, 'store']);
    
    // PATCH /api/products/{id} - Atualizar
    Route::patch('/{id}', [ProductController::class, 'update']);
    
    // DELETE /api/products/{id} - Deletar
    Route::delete('/{id}', [ProductController::class, 'destroy']);
});

Route::prefix('property')->group(function () {
    Route::get('/', [PropertyController::class, 'index']);
    // Route::get('/{id}', [PropertyController::class, 'show']);
    Route::post('/', [PropertyController::class, 'store']);
    // Route::patch('/{id}', [PropertyController::class, 'update']);
    Route::delete('/{id}', [PropertyController::class, 'destroy']);
});