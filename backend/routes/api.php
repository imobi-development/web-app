<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::get('/hello', function () {
    return response()->json(['message' => 'Olá do Laravel!']);
});

// Produtos
Route::get('/products', function (Request $request) {
    // Simula dados do banco (substitua com Product::paginate())
    $products = [
        'data' => [
            [
                'id' => 1,
                'name' => 'Notebook Dell',
                'description' => 'Notebook i7 16GB RAM',
                'price' => 3500.00,
                'stock' => 15,
                'category' => 'Eletrônicos',
                'created_at' => '2025-01-15',
            ],
            [
                'id' => 2,
                'name' => 'Mouse Logitech',
                'description' => 'Mouse sem fio',
                'price' => 89.90,
                'stock' => 50,
                'category' => 'Periféricos',
                'created_at' => '2025-01-16',
            ],
            [
                'id' => 3,
                'name' => 'Teclado Mecânico',
                'description' => 'Teclado RGB',
                'price' => 450.00,
                'stock' => 25,
                'category' => 'Periféricos',
                'created_at' => '2025-01-17',
            ],
        ],
        'current_page' => 1,
        'last_page' => 1,
        'per_page' => 10,
        'total' => 3,
    ];
    
    return response()->json($products);
});

// 2. GET - Buscar um produto específico por ID
Route::get('/products/{id}', function ($id) {
    // Simula busca no banco (substitua com Product::findOrFail($id))
    $product = [
        'id' => $id,
        'name' => 'Notebook Dell',
        'description' => 'Notebook i7 16GB RAM 512GB SSD',
        'price' => 3500.00,
        'stock' => 15,
        'category' => 'Eletrônicos',
        'sku' => 'DELL-I7-2024',
        'weight' => 2.5,
        'created_at' => '2025-01-15',
        'updated_at' => '2025-01-15',
    ];
    
    return response()->json($product);
});

// 3. POST - Criar um novo produto
Route::post('/products', function (Request $request) {
    // Validação
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'nullable|string',
        'price' => 'required|numeric|min:0',
        'stock' => 'required|integer|min:0',
        'category' => 'required|string',
    ]);
    
    // Simula criação (substitua com Product::create($validated))
    $newProduct = [
        'id' => rand(100, 999), // ID simulado
        'name' => $validated['name'],
        'description' => $validated['description'] ?? '',
        'price' => $validated['price'],
        'stock' => $validated['stock'],
        'category' => $validated['category'],
        'created_at' => now()->toDateTimeString(),
        'updated_at' => now()->toDateTimeString(),
    ];
    
    return response()->json($newProduct, 201); // 201 = Created
});

// 4. PUT/PATCH - Atualizar um produto
Route::patch('/products/{id}', function (Request $request, $id) {
    // Validação
    $validated = $request->validate([
        'name' => 'sometimes|string|max:255',
        'description' => 'sometimes|string',
        'price' => 'sometimes|numeric|min:0',
        'stock' => 'sometimes|integer|min:0',
        'category' => 'sometimes|string',
    ]);
    
    // Simula atualização (substitua com Product::find($id)->update($validated))
    $updatedProduct = [
        'id' => $id,
        'name' => $validated['name'] ?? 'Notebook Dell',
        'description' => $validated['description'] ?? 'Notebook i7',
        'price' => $validated['price'] ?? 3500.00,
        'stock' => $validated['stock'] ?? 15,
        'category' => $validated['category'] ?? 'Eletrônicos',
        'updated_at' => now()->toDateTimeString(),
    ];
    
    return response()->json($updatedProduct);
});

// 5. DELETE - Deletar um produto
Route::delete('/products/{id}', function ($id) {
    // Simula deleção (substitua com Product::destroy($id))
    
    return response()->json([
        'message' => 'Produto deletado com sucesso',
        'id' => $id
    ], 200);
});

// 6. GET - Buscar produtos por categoria
Route::get('/products/category/{category}', function ($category) {
    $products = [
        [
            'id' => 2,
            'name' => 'Mouse Logitech',
            'price' => 89.90,
            'category' => $category,
        ],
        [
            'id' => 3,
            'name' => 'Teclado Mecânico',
            'price' => 450.00,
            'category' => $category,
        ],
    ];
    
    return response()->json($products);
});