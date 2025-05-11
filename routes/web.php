<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodoController;
use App\Http\Controllers\CategoryController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth'])->group(function () {

    // Dashboard
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Todo Routes
    Route::resource('todo', TodoController::class);
    Route::patch('/todo/{todo}/toggle-complete', [TodoController::class, 'toggleComplete'])->name('todo.toggleComplete');

    // Category Routes
    Route::resource('categories', CategoryController::class);
});

require __DIR__.'/auth.php';
