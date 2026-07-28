<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Events\NewUserRegistered;
use App\Listeners\SendAdminNewUserNotification;

class EventServiceProvider extends ServiceProvider
{

    protected $listen = [
        // ... otros eventos
        NewUserRegistered::class => [
            SendAdminNewUserNotification::class,
        ],
    ];
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
