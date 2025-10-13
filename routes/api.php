<?php

use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\TaskController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
Route::post('/auth', LoginController::class);
Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('tasks', TaskController::class);
});
