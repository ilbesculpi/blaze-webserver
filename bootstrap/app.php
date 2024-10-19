<?php

use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Http\Request;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        //
    })
    ->withExceptions(function(Exceptions $exceptions) {
        $exceptions->render(function(AuthenticationException $e, Request $request) {
            return response()->json([
                'result' => 'error',
                'message' => 'Not Authenticated',
                'info' => env('APP_DEBUG', false) ? $e->getMessage() : null,
            ], 401);
        });
        $exceptions->render(function(NotFoundHttpException $e, Request $request) {
            return response()->json([
                'result' => 'error',
                'message' => 'Resource Not Found X(',
                'info' => env('APP_DEBUG', false) ? $e->getMessage() : null,
            ], 404);
        });
        $exceptions->render(function(QueryException $e, Request $request) {
            return response()->json([
                'result' => 'error',
                'message' => 'Database Error',
                'info' => env('APP_DEBUG', false) ? $e->getMessage() : null,
                'exception' => $e::class,
            ], 500);
        });
    })
    ->create();
