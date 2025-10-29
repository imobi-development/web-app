<?php

namespace App\Helpers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class ApiResponseHelper
{
    /**
     * Retorna resposta paginada padrão
     * Formato: { success: true, data: [...], meta: {...} }
     */
    public static function showAllPaginate(
        array $items, 
        Request $request, 
        int $perPage = 2,
        string $message = 'Dados recuperados com sucesso'
    ): JsonResponse {
        $page = $request->query('page', 1);
        $total = count($items);
        $lastPage = ceil($total / $perPage);
        $offset = ($page - 1) * $perPage;
        
        return response()->json([
            'success' => true,
            'message' => $message,
            'data' => array_slice($items, $offset, $perPage),
            'pagination' => [
                'current_page' => (int)$page,
                'last_page' => $lastPage,
                'per_page' => $perPage,
                'total' => $total,
                'from' => $offset + 1,
                'to' => min($offset + $perPage, $total),
            ]
        ]);
    }
    
    /**
     * Retorna resposta de sucesso simples
     */
    // public static function success($data, string $message = 'Operação realizada com sucesso', int $statusCode = 200): JsonResponse
    // {
    //     return response()->json([
    //         'success' => true,
    //         'message' => $message,
    //         'data' => $data,
    //     ], $statusCode);
    // }
    
    /**
     * Retorna resposta de erro
     */
    // public static function error(string $message, int $statusCode = 400, array $errors = []): JsonResponse
    // {
    //     return response()->json([
    //         'success' => false,
    //         'message' => $message,
    //         'errors' => $errors,
    //     ], $statusCode);
    // }
    
    /**
     * Retorna resposta de item único
     */
    public static function showOne($item, string $message = 'Dados recuperados com sucesso'): JsonResponse
    {
        return response()->json([
            'success' => true,
            'message' => $message,
            'data' => $item,
        ]);
    }
    
    /**
     * Retorna resposta de criação
     */
    // public static function created($data, string $message = 'Recurso criado com sucesso'): JsonResponse
    // {
    //     return response()->json([
    //         'success' => true,
    //         'message' => $message,
    //         'data' => $data,
    //     ], 201);
    // }
    
    /**
     * Retorna resposta de atualização
     */
    // public static function updated($data, string $message = 'Recurso atualizado com sucesso'): JsonResponse
    // {
    //     return response()->json([
    //         'success' => true,
    //         'message' => $message,
    //         'data' => $data,
    //     ]);
    // }
    
    /**
     * Retorna resposta de deleção
     */
    // public static function deleted(string $message = 'Recurso deletado com sucesso'): JsonResponse
    // {
    //     return response()->json([
    //         'success' => true,
    //         'message' => $message,
    //     ]);
    // }
}