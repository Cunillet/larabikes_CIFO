<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\URL;

class CustomVerifyEmail extends Notification implements ShouldQueue
{
    use Queueable;

    public function via(object $notifiable)
    {
        return ['mail'];
    }

    public function toMail(object $notifiable)
    {
        $verificationUrl = $this->verificationUrl($notifiable);

        return (new MailMessage)
            ->subject('Verify Your Email - ' . config('app.name'))
            ->greeting('Hi ' . $notifiable->name . '!')
            ->line('Thank you for register in ' . config('app.name') . '.')
            ->line('Please confirm your email accessing the following link:')
            ->action('Verify Email', $verificationUrl)
            ->line('If you did not create an account in our site, please ignore this email.')
            ->salutation('Greetings, ' . config('app.name'));
    }

    protected function verificationUrl(object $notifiable)
    {
        return URL::temporarySignedRoute(
            'verification.verify',
            Carbon::now()->addMinutes(60),
            [
                'id' => $notifiable->getKey(),
                'hash' => sha1($notifiable->getEmailForVerification()),
            ]
        );
    }
}
