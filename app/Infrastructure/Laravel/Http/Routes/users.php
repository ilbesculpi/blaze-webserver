<?php

/*
|--------------------------------------------------------------------------
| User Api Routes
|--------------------------------------------------------------------------
|
| Routes for User Domain Api.
|
*/

use Illuminate\Support\Facades\Route;
use App\Infrastructure\Laravel\Http\Api\UserController;

Route::apiResource('users', UserController::class)
    ->middleware('auth:sanctum');
