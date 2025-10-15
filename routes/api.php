<?php

use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\TaskController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
Route::prefix('')->as('api.')->group(function () {
    Route::middleware('auth:sanctum')->group(function () {
        Route::apiResource('tasks', TaskController::class);
    });
    Route::post('/auth', LoginController::class);
});
