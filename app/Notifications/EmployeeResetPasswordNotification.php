<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class EmployeeResetPasswordNotification extends Notification
{
    public $token;
    public $email;

    public function __construct($token, $email)
    {
        $this->token = $token;
        $this->email = $email;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        $url = 'https://fineoutput.co.in/booking_portal/public/reset-password?token=' . $this->token . '&email=' . urlencode($this->email);
    
        return (new MailMessage)
            ->subject('Reset Password')
            ->greeting('Hello!')
            ->line('Click below to reset your password:')
            ->action('Reset Password', $url)
            ->line('This link will expire in 60 minutes.')
            ->salutation('Regards, Crestview');
    }
    
}
