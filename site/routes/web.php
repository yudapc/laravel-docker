<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TodoController;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('categories', CategoryController::class);
Route::resource('todos', TodoController::class);
Route::patch('todos/{id}/complete', [TodoController::class, 'updatestatus'])->name('todos.complete');