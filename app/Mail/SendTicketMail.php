<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendTicketMail extends Mailable
{
    use Queueable, SerializesModels;

    public $ticket;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($ticket)
    {
        $this->ticket = $ticket;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $mail = $this->subject('Ticket ID - #' . $this->ticket->id . ', ' . $this->ticket->subject)
            ->replyTo($this->ticket->email, $this->ticket->name)
            ->view('emails.ticketmail');

        if (!blank($this->ticket->getMedia('ticket'))) {
            foreach ($this->ticket->getMedia('ticket') as $mediaticket) {
                $mail->attach($mediaticket->getPath());
            }
        }

        return $mail;
    }
}
