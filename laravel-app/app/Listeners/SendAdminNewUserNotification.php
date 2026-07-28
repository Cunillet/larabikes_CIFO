<?php
namespace App\Listeners;

use App\Events\NewUserRegistered;
use App\Mail\NewUserNotification;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

class SendAdminNewUserNotification
{
    public function handle(NewUserRegistered $event)
    {
        $user = $event->user;

        $admins = User::whereHas('roles', function($query) {
            $query->where('role_id', 1);
        })->get();

        if ($admins->isEmpty()) {
            Mail::to('admin@tudominio.com')->send(new NewUserNotification($user));
        } else {
            foreach ($admins as $admin) {
                Mail::to($admin->email)->send(new NewUserNotification($user));
            }
        }
    }
}
