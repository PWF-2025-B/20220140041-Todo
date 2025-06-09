<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;

// Public routes (tidak butuh authentication)
Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']); // tambahkan jika ada

// Protected routes (butuh authentication)
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    
    Route::post('/logout', [AuthController::class, 'logout']);
    
    // Tambahkan route API lainnya di sini
    // Route::get('/todos', [TodoController::class, 'index']);
    // Route::post('/todos', [TodoController::class, 'store']);
    // dst...
});