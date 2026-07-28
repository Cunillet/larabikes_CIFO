<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\BikeApiController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Authentication
|--------------------------------------------------------------------------
*/
Route::post('/register', [AuthController::class, 'register'])->name('api.register');
Route::post('/login', [AuthController::class, 'login'])->name('api.login');

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('api.logout');
    Route::get('/user', [AuthController::class, 'user'])->name('api.user');
});

/*
|--------------------------------------------------------------------------
| API Bikes — Rutas públicas
|--------------------------------------------------------------------------
*/
Route::get('bikes/search', [BikeApiController::class, 'search'])->name('api.bikes.search');
Route::get('bikes/{id}', [BikeApiController::class, 'show'])->name('api.bikes.show');
Route::get('bikes', [BikeApiController::class, 'index'])->name('api.bikes.index');

/*
|--------------------------------------------------------------------------
| API Bikes — Rutas protegidas (requieren token Sanctum)
|--------------------------------------------------------------------------
*/
Route::middleware('auth:sanctum')->group(function () {
    Route::post('bikes', [BikeApiController::class, 'store'])->name('api.bikes.store');
    Route::put('bikes/{id}', [BikeApiController::class, 'update'])->name('api.bikes.update');
    Route::delete('bikes/{id}', [BikeApiController::class, 'destroy'])->name('api.bikes.destroy');
    Route::post('bikes/{id}/restore', [BikeApiController::class, 'restore'])->name('api.bikes.restore');
    Route::delete('bikes/{id}/force', [BikeApiController::class, 'forceDelete'])->name('api.bikes.force-delete');
});
