<?php

namespace App\Jobs;

use App\Mail\EventAdded;
use App\Models\Event;
use App\Models\Participant;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class SendEventNotification implements ShouldQueue
{
    use Queueable, Dispatchable;


    /**
     * Create a new job instance.
     */
    public function __construct(
        public Event $event, public Participant $participant
    )
    {
       //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {        
        Mail::to($this->participant->email)->queue(new EventAdded($this->event , $this->participant));
        // Log::info("Sending email to {$this->participant->email} for event {$this->event->id}");

    }
}
