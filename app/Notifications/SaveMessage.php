<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use App\Ticket;
use App\Message;

class SaveMessage extends Notification
{
    use Queueable;

    protected $ticket;
    protected $message;

    public function __construct(Ticket $ticket, Message $message)
    {
        $this->ticket = $ticket;
        $this->message = $message;
    }
    
    public function via($notifiable)
    {
        return ['mail'];
    }
    
    public function toMail($notifiable)
    {
        $url = route('ticketView', $this->ticket->id);
        return (new MailMessage)
                    ->subject('Nova Mensagem')
                    ->greeting('Olá, ' . $this->ticket->getUser->getFirstNameFormatted())
                    ->line('Você receu uma nova mensagem no seu ticket ' . $this->ticket->getIdFormatted() . ':')
                    ->line('"' . $this->message->message . '"')
                    ->line('Você pode acompanhá-lo clicando no link abaixo.')
                    ->action('Visualizar Ticket', $url);
    }

    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}