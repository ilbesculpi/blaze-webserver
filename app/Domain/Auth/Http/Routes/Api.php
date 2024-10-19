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
use App\Domain\Auth\Http\Controllers\Api\AuthController;

Route::post('/auth/token', [AuthController::class, 'token']);
