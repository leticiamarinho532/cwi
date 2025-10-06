<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HealthController;

Route::apiResource('users', UserController::class);

Route::get('/health', [HealthController::class, 'index']);