<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TodoController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth'])->group(function () {
    Route::resource('categories', CategoryController::class);
    Route::resource('todos', TodoController::class);
    Route::patch('todos/{id}/complete', [TodoController::class, 'updatestatus'])->name('todos.complete');
});


Route::get('register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('register', [AuthController::class, 'register']);
Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout'])->name('logout');
Route::get('password/reset', [AuthController::class, 'showForgotPasswordForm'])->name('password.request');
Route::post('password/email', [AuthController::class, 'sendResetLink'])->name('password.email');


Route::middleware(['auth', 'role:super-admin'])->group(function () {
    Route::resource('users', UserController::class);
});

