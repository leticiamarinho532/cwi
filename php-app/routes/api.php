<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HealthController;
use App\Http\Controllers\ExternalController;

Route::apiResource('users', UserController::class);

Route::get('/health', [HealthController::class, 'handle']);

Route::get('/external', [ExternalController::class, 'handle']);