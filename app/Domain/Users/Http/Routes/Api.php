<?php

use Illuminate\Support\Facades\Route;
use App\Domain\Users\Http\Controllers\Api\UserController;
use App\Domain\Users\Models\User;

Route::apiResource('users', UserController::class)
    ->middleware('auth:sanctum');
