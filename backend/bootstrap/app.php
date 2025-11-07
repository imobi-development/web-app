<?php

use App\Http\Middleware\AuthenticateCookie;
use App\Http\Middleware\ForceJsonResponse;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Middleware\HandleCors;
use Illuminate\Http\Request;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->prepend(HandleCors::class);
        $middleware->group('api', [
            ForceJsonResponse::class, // Força retornar JSON ao Invez da página do Html do Laravel
            AuthenticateCookie::class,
            Illuminate\Routing\Middleware\SubstituteBindings::class
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        // Se der algum erro inesperado na chamada da Api
        // Não deixa ele renderizar a pagina de erro do Laravel
        // e retorna o erro como Json.
        $exceptions->shouldRenderJsonWhen(function (Request $request) {
            if ($request->is('api/*')) {
                return true;
            }

            return $request->expectsJson();
        });
    })->create();
