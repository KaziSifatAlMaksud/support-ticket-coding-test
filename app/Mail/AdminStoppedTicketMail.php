<?php

namespace App\Mail;

use App\Models\CustomerTicket;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AdminStoppedTicketMail extends Mailable
{
    use Queueable, SerializesModels;

    public $ticket;

    /**
     * Create a new message instance.
     *
     * @param Ticket $ticket
     */
    public function __construct(CustomerTicket $ticket)
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
        return $this->subject('Ticket Stopped: ' . $this->ticket->ticket_title)
                    ->view('email.ticket_stop_email')
                    ->with([
                        'ticketTitle' => $this->ticket->ticket_title,
                        'issueDetails' => $this->ticket->issue_details,
                        'status' => 'Closed',
                    ]);
    }
}
