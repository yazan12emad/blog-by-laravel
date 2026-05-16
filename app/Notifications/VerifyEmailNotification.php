<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\URL;

class VerifyEmailNotification extends Notification
{
    use Queueable;

    public function __construct(){}

    public function via(object $notifiable): array
    {
        return ['mail' , 'database'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        $verificationUrl = $this->verificationUrl($notifiable);
             return (new MailMessage)
                 ->subject('Verify Your Email Address')
                 ->greeting('Hello ' . $notifiable->name . '!')
                 ->line('Please click the button below to verify your email address.')
                 ->action('Verify Your Email Address', $verificationUrl) // ← the button
                 ->line('This link expires in 60 minutes.')
                 ->line('If you did not create an account, ignore this email.');
    }
    // the verificationUrl to create a unique URL just for this user
    protected function verificationUrl(object $notifiable): string
    {
        // these function create a hash URL for varify the email and make it expire after 60 minutes
        return URL::temporarySignedRoute(
            'verification.verify',
            Carbon::now()->addMinutes(Config::get('auth.verification.expire', 60)),
            [
                'id'   => $notifiable->getKey(), // return the user ID
                'hash' => sha1($notifiable->getEmailForVerification()), // return the user email
            ]
        );
    }
    public function toArray(object $notifiable): array
    {
        // used for store the message in the notification table
        return [
            'title'   => 'Email Verification',
            'user_id' => $notifiable->id,
            'message' => 'A verification email has been sent to ' . $notifiable->email,
            'sent_at' => now(),
        ];
    }
}
