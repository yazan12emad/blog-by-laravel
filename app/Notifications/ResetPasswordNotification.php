<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\URL;

class ResetPasswordNotification extends Notification
{
    use Queueable;

    public string $code;

    public function __construct(string $code)
    {
        $this->code = $code;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $resetPasswordUrl = $this->resetPasswordUrl($notifiable);

        return (new MailMessage)
                ->subject('Reset Password')
                ->line('You are receiving this email because we received a password reset request for your account.')
                ->line('This password reset code will expire in 60 minutes.')
                ->line('Your password reset code is: ' . $this->code)
                ->action('Reset Password', $resetPasswordUrl)
                ->line('If you did not request a password reset, no further action is required.');
    }

    public function resetPasswordUrl(object $notifiable): string
    {
        return URL::temporarySignedRoute(
            'change-password.form',
            now()->addMinutes(60),
            ['email' => $notifiable->getEmailForPasswordReset()]
        );
    }

    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
