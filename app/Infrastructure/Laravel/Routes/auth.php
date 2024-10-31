<?php

/*
|--------------------------------------------------------------------------
| Auth Api Routes
|--------------------------------------------------------------------------
|
| Routes for Auth Domain Api.
|
*/

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Infrastructure\Laravel\Controllers\Api\AuthController;

Route::post('/auth/token', [AuthController::class, 'token']);
