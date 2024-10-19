<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\AuthController;
// use App\Http\Controllers\UserController;

Route::get('/info', function(Request $request) {
    return response()->json([
        'app' => env('APP_NAME'),
        'version' => env('APP_VERSION', '1.0'),
        'env' => env('APP_ENV', 'local'),
        'url' => env('APP_URL', 'http://localhost'),
    ]);
});

Route::get('/me', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
