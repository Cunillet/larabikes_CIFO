<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BikeController;
use App\Http\Controllers\TermsController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\UserController;

/** HOME PAGE */
Route::get('/', function () {
    return view('welcome');
})->name('welcome');
/**
 * With middleware
 * Route::get('/', function () {
 *      return view('welcome');
 * })->name('welcome')->middleware('checkage:15');
 */

/** BIKE CRUD */
Route::get('motos/list', [BikeController::class, 'list'])
    ->name('bikes.list');
Route::get('/motos/search/{brand?}/{model?}', [BikeController::class, 'search'])
    ->name('bikes.search');
Route::delete('motos/{bike}/image', [BikeController::class, 'destroyImage'])
    ->name('bikes.destroyImage');
Route::get('/motos/{bike}/delete', [BikeController::class, 'delete'])
    ->name('bikes.delete')->middleware(['checkage:15', 'throttle:3,1']);
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
    ])->parameters(['motos' => 'bike']);

/** PROFILE */
Route::get('profile', [UserController::class, 'show'])
    ->name('profile.show')->middleware(['auth']);
Route::get('edit', [UserController::class, 'edit'])
    ->name('profile.edit')->middleware(['auth']);
Route::put('/profile', [UserController::class, 'update'])
    ->name('profile.update');
Route::get('reset-password/{token}', function ($token) {
    return view('auth.reset-password', ['token' => $token]);
})->middleware('guest')->name('password.reset');
Route::get('forgot-password', function () {
    return view('auth.forgot-password');
})->middleware('guest')->name('password.request');

/** PROFILE & 2FA */
Route::get('two-factor-profile', function () {
    return view('auth.two-factor-profile');
})->middleware(['auth'])->name('auth.two-factor-profile');

/** CONTACT */
Route::get('contact', [ContactController::class, 'index'])
    ->name('contact');
Route::post('contact', [ContactController::class, 'send'])
    ->name('contacts.send');

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

// Debug test route - set breakpoints here
Route::get("/debug", function () {
    $testData = [
        "message" => "Xdebug is working!",
        "items" => ["Apple", "Banana", "Cherry"],
        "timestamp" => now()->toDateTimeString()
    ];
    
    $processed = array_map(function($item) {
        return strtoupper($item);  // Set breakpoint here
    }, $testData["items"]);
    
    return response()->json([
        "status" => "success",
        "original" => $testData,
        "processed" => $processed
    ]);
});
