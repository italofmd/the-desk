<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use App\Mail\ResetPassword as Maillable;

class ResetPassword extends Notification
{
    use Queueable;

    private $token;

    public function __construct($token)
    {
        $this->token = $token;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }      

    public function toMail($notifiable)
    {
        $subject = "Redefinir Senha";
        return (new Maillable($this->token, $notifiable))->subject($subject)->to($notifiable->email);
    }
    
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
