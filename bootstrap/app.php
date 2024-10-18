<?php

use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Translation\Exception\NotFoundResourceException;
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
                'result' => false,
                'message' => 'Not Authenticated :('
            ], 401);
        });
        $exceptions->render(function(NotFoundHttpException $e, Request $request) {
            return response()->json([
                'result' => false,
                'message' => 'Resource Not Found :('
            ], 404);
        });
    })
    ->create();
