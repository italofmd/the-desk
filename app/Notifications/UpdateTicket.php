<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use App\Ticket;

class UpdateTicket extends Notification
{
    use Queueable;
    
    protected $ticket;

    public function __construct(Ticket $ticket)
    {
        $this->ticket = $ticket;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        $url = route('ticketView', $this->ticket->id);
        return (new MailMessage)
                    ->subject('Ticket Atualizado')
                    ->greeting('Olá, ' . $this->ticket->getUser->getFirstNameFormatted())
                    ->line('O status do seu ticket ' . $this->ticket->getIdFormatted() . ' foi alterado para "'.$this->ticket->getStatus->name.'", você pode acompanhá-lo clicando no link abaixo.')
                    ->action('Visualizar Ticket', $url);
    }

    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
