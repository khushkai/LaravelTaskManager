<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\AuthController;
use App\Http\Controllers\Web\TaskController;
use App\Http\Controllers\Api\AuthApiController;
use App\Http\Controllers\Api\TaskApiController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('guest')->group(function () {

    Route::get('/register', [AuthController::class, 'registerForm'])->name('registerForm');
    Route::post('/register', [AuthController::class, 'register'])->name('register');

    Route::get('/login', [AuthController::class, 'loginForm'])->name('loginForm');
    Route::post('/login', [AuthController::class, 'login'])->name('login');

});

Route::post('login', [AuthApiController::class, 'login']);

Route::middleware('auth:api')->group(function () {

    Route::post('logout', [AuthApiController::class, 'logout']);

    Route::apiResource('tasks', TaskApiController::class);
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/dashboard', [TaskController::class, 'dashboard'])->name('dashboard');

    Route::get('/task', [TaskController::class, 'index'])->name('task.list');
    Route::get('/task/add', [TaskController::class, 'create'])->name('task.add');
    Route::post('/task/store', [TaskController::class, 'store'])->name('task.store');
    Route::get('/task/{task}/edit', [TaskController::class, 'edit'])->name('task.edit');
    Route::put('/task/{task}/update', [TaskController::class, 'update'])->name('task.update');
    Route::delete('/task/{task}/delete', [TaskController::class, 'destroy'])->name('task.delete');
    Route::get('/task/{task}/view', [TaskController::class, 'show'])->name('task.show');
});