<?php

namespace App\Mail;

use App\Models\Event;
use App\Models\Participant;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Contracts\Queue\ShouldQueue;

class EventAdded extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct(
        public Event $event, public Participant $participant
    )
    {
        //
    }

    /**
     * Get the message envelope.
     */
    // public function envelope(): Envelope
    // {
    //     return new Envelope(
    //         subject: 'Event has been assigned',
    //     );
    // }

    // /**
    //  * Get the message content definition.
    //  */
    // public function content(): Content
    // {
    //     return Content::textString(
    //         <<<TEXT
    //     Hello {$this->participant->name},
        
    //     You are invited to: {$this->event->name}
    //     Date: {$this->event->date}
    //     TEXT
    //     );
    // }

    // /**
    //  * Get the attachments for the message.
    //  *
    //  * @return array<int, \Illuminate\Mail\Mailables\Attachment>
    //  */
    // public function attachments(): array
    // {
    //     return [];
    // }

    public function build()
    {
        $body = "Hello {$this->participant->first_name},\n"
              . "You are invited to: {$this->event->name}\n"
              . "Date: {$this->event->date}";

        return $this->subject('Event has been assigned')
                    ->text(new \Illuminate\Support\HtmlString($body));
    }
}
