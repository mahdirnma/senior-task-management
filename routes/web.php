<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserTaskController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::middleware('isAdmin')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('home');
        Route::resource('tasks', TaskController::class);
    });
    Route::get('/users/tasks', [UserTaskController::class, 'index'])->name('user.tasks');
    Route::put('/users/tasks/{task}/status', [UserTaskController::class, 'taskStatus'])->name('user.tasks.status');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'loginForm'])->name('login.form');
    Route::post('/login', [AuthController::class, 'login'])->name('login');
});
