<?php

use App\Http\Controllers\Api\BikeApiController;
use Illuminate\Support\Facades\Route;



Route::apiResource('bikes', BikeApiController::class);

// Rutas adicionales
Route::get('bikes/search', [BikeApiController::class, 'search'])->name('api.bikes.search');
Route::post('bikes/{id}/restore', [BikeApiController::class, 'restore'])->name('api.bikes.restore');
Route::delete('bikes/{id}/force', [BikeApiController::class, 'forceDelete'])->name('api.bikes.force-delete');
