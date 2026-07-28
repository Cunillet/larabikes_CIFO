<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;
use App\Http\Middleware\CheckAge;
use App\Http\Middleware\IsAdmin;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        /** 
         * Add middleware everywhere
         * $middleware->append(CheckAge::class);
         **/

        // Add middleware alias to call it in some routes
        $middleware->alias([
            'checkage' => CheckAge::class,
            'is_admin' => IsAdmin::class,
        ]);

        // Add exceptions to cookie encrypt
        $middleware->encryptCookies(except: ['lastUpdateId']);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->shouldRenderJsonWhen(
            fn (Request $request) => $request->is('api/*'),
        );
    })->create();
