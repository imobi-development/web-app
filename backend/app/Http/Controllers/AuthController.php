<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Auth\RegisterRequest;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register(RegisterRequest $request): JsonResponse
    {
        try {
            $validatedData = $request->validated();

            // Lógica de verificação de email aqui

            $user = User::create([
                'name' => $validatedData['name'],
                'email' => $validatedData['email'],
                'password' => Hash::make($validatedData['password']),
                'phone' => $validatedData['phone'],
                'avatar' => $validatedData['avatar'],
                'user_type' => $validatedData['user_type'],
                'is_active' => $validatedData['is_active'],
            ]);

            return response()->json(['message' => 'Usuário criado com sucesso'], 201);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Erro ao criar usuário', 'error' => $e->getMessage()], 500);
        }
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json(['message' => 'Credenciais Inválidas'], 401);
        }

        $user = User::where('email', $request->email)->first();

        if (!$user->is_active) {
            return response()->json(['message' => 'Usuário Inativo'], 401);
        }

        $user->tokens()->delete(); // Revoga Tokens Antigos
        $token = $user->createToken('access_token');
        $cookie = cookie('auth_token', $token->plainTextToken, 60 * 24 * 30, '/', null, false, true, false, 'lax');

        return response()->json(['message' => 'Login realizado com sucesso'], 200)->cookie($cookie);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        $cookie = cookie()->forget('auth_token');
        return response()->json(['message' => 'Logout realizado com sucesso'], 200)->cookie($cookie);
    }
}
