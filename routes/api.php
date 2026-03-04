<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthApiController;
use App\Http\Controllers\Api\TaskApiController;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');


Route::post('login', [AuthApiController::class, 'login'])->name('api.login');

Route::middleware('auth:api')
    ->name('api.') 
    ->group(function () {

        Route::post('logout', [AuthApiController::class, 'logout'])->name('logout');

        Route::apiResource('tasks', TaskApiController::class);
});