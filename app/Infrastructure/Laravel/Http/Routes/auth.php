<?php

/*
|--------------------------------------------------------------------------
| Auth Api Routes
|--------------------------------------------------------------------------
|
| Routes for Auth Domain Api.
|
*/

use Illuminate\Support\Facades\Route;
use App\Infrastructure\Laravel\Http\Api\AuthController;

Route::post('/auth/token', [AuthController::class, 'token']);
