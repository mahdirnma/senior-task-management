<?php

use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\TaskController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
Route::post('/auth', LoginController::class);
Route::apiResource('tasks', TaskController::class);
