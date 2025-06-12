<?php

namespace App\Listeners;

use App\Events\EventCreated;
use App\Jobs\SendEventNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendEventCreatedEmail
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(EventCreated $event): void
    {
        $participant = $event->participant;
        $participant->load('events');
        if($participant->events)
        {
            foreach($participant->events as $event_item)
            {
                SendEventNotification::dispatch($event_item,$participant)->onQueue('mail');
            }
        }        
    }
}
