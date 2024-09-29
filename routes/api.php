<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PqrController;
use App\Http\Controllers\UserController;

Route::get('/pqrs', [PqrController::class, 'index']);
Route::post('/pqrs', [PqrController::class, 'store']);
Route::get('/pqrs/{id}', [PqrController::class, 'show']);
Route::put('/pqrs/{id}', [PqrController::class, 'update']);
Route::delete('/pqrs/{id}', [PqrController::class, 'destroy']);

Route::get('/users', [UserController::class, 'index']);
Route::post('/users', [UserController::class, 'store']);
Route::get('/users/{id}', [UserController::class, 'show']);
Route::put('/users/{id}', [UserController::class, 'update']);
Route::delete('/users/{id}', [UserController::class, 'destroy']);
