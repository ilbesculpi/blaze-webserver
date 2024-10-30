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
use App\Infrastructure\Laravel\Controllers\Api\UserController;
use App\Domain\Users\Models\User;

Route::apiResource('users', UserController::class)
    ->middleware('auth:sanctum');
