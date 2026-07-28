<?php

namespace App\Listeners;

use App\Events\NewUserRegistered;
use Illuminate\Auth\Events\Registered;

class HandleUserRegistration
{
    public function handle(Registered $event)
    {
        $user = $event->user;
        
        // Dispara el evento personalizado
        event(new NewUserRegistered($user));
    }
}
