<?php

use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\TaskController;
use App\Http\Controllers\Api\UserTaskController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
Route::prefix('')->as('api.')->group(function () {
    Route::middleware('auth:sanctum')->group(function () {
        Route::apiResource('tasks', TaskController::class);
        Route::get('/users/tasks', [UserTaskController::class, 'getUserTasks'])->name('user.tasks');
        Route::put('/users/tasks/{task}/status', [UserTaskController::class, 'changeTaskStatus'])->name('user.tasks.status');
    });
    Route::post('/auth', LoginController::class);
});
