<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Helpers\ApiResponseHelper;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    /**
     * Lista todos os produtos com paginação
     * GET /api/products
     */
    public function index(Request $request): JsonResponse
    {
        $products = [
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
            [
                'id' => 4,
                'name' => 'Monitor LG 27"',
                'description' => 'Monitor Full HD',
                'price' => 1200.00,
                'stock' => 10,
                'category' => 'Periféricos',
                'created_at' => '2025-01-18',
            ],
            [
                'id' => 5,
                'name' => 'Webcam Logitech',
                'description' => 'Webcam HD 1080p',
                'price' => 350.00,
                'stock' => 30,
                'category' => 'Periféricos',
                'created_at' => '2025-01-19',
            ],
            [
                'id' => 6,
                'name' => 'Headset Gamer',
                'description' => 'Headset 7.1 RGB',
                'price' => 280.00,
                'stock' => 20,
                'category' => 'Periféricos',
                'created_at' => '2025-01-20',
            ],
        ];
        
        return ApiResponseHelper::showAllPaginate($products, $request, 2);
    }

    /**
     * Busca um produto específico por ID
     * GET /api/products/{id}
     */
    public function show(int $id): JsonResponse
    {
        // Simula busca (depois substitua por Product::findOrFail($id))
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
        
        return ApiResponseHelper::showOne($product);
    }

    /**
     * Cria um novo produto
     * POST /api/products
     */
    public function store(Request $request): JsonResponse
    {
        // Validação
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'category' => 'required|string',
        ]);
        
        // Simula criação (depois substitua por Product::create($validated))
        $newProduct = [
            'id' => rand(100, 999),
            'name' => $validated['name'],
            'description' => $validated['description'] ?? '',
            'price' => $validated['price'],
            'stock' => $validated['stock'],
            'category' => $validated['category'],
            'created_at' => now()->toDateTimeString(),
            'updated_at' => now()->toDateTimeString(),
        ];
        
        return response()->json($newProduct, 201);
    }

    /**
     * Atualiza um produto existente
     * PATCH /api/products/{id}
     */
    public function update(Request $request, int $id): JsonResponse
    {
        // Validação (todos os campos opcionais)
        $validated = $request->validate([
            'name' => 'sometimes|string|max:255',
            'description' => 'sometimes|string',
            'price' => 'sometimes|numeric|min:0',
            'stock' => 'sometimes|integer|min:0',
            'category' => 'sometimes|string',
        ]);
        
        // Simula atualização (depois substitua por Product::find($id)->update($validated))
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
    }

    /**
     * Deleta um produto
     * DELETE /api/products/{id}
     */
    public function destroy(int $id): JsonResponse
    {
        // Simula deleção (depois substitua por Product::destroy($id))
        
        return response()->json([
            'message' => 'Produto deletado com sucesso',
            'id' => $id
        ]);
    }

    /**
     * Busca produtos por categoria
     * GET /api/products/category/{category}
     */
    public function byCategory(string $category): JsonResponse
    {
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
    }
}