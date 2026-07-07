<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BikeController;
use App\Http\Controllers\TermsController;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');
/**
 * With middleware
 * Route::get('/', function () {
 *      return view('welcome');
 * })->name('welcome')->middleware('checkage:15');
 */

Route::get('motos/list', [BikeController::class, 'list'])
    ->name('bikes.list');
Route::get('/motos/search/{brand?}/{model?}', [BikeController::class, 'search'])
    ->name('bikes.search');
// define all standard by default with default methods
// Route::resource('bikes', BikeController::class);
Route::resource('motos', BikeController::class)
    ->names([
        'show' => 'bikes.show',
        'index' => 'bikes.index',
        'create' => 'bikes.create',
        'store' => 'bikes.store',
        'edit' => 'bikes.edit',
        'update' => 'bikes.update',
        'destroy' => 'bikes.destroy',
    ]);

// after standard routes, add custom ones
Route::get('/motos/{bike}/delete', [BikeController::class, 'delete'])
    ->name('bikes.delete')->middleware(['checkage:15', 'throttle:3,1']);


/**
 * Suplement Paths
 */
// Display terms & conditions
// Single action controller --> no method definition required, no array of classes
Route::get('/terms-and-conditions', TermsController::class)
    ->name('terms');


/**
 * Testing
 */
Route::get('/test/download', function() {
    return response()->download(
        public_path('images/bike0.png'),
        'Akira.png'
        // ['Content-type' => 'image/png']
    );
    // ->deletefileAfterSend(true);
});
Route::get('/test/view', function() {
    return response()->file(
        public_path('images/bike0.png'),
        ['Content-type' => 'image/png']
    );
});

Route::get('/test/redirect', function() {
    // return redirect($to = null, $status = 302, $headers = [], $secure = null);
    // return redirect('/motos');
    // return redirect()->route('welcome');
    return response()
        ->view('welcome', [
            'message' => 'Redirecting to Google...',
            'time' => 5,
            ])
        ->header('Refresh', '5;url=https://www.google.es');
});

Route::get('/test/signature', function() {
    abort(401, 'Access denied');
});
