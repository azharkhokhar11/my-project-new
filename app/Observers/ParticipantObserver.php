<?php

namespace App\Observers;

use App\Models\Participant;
use App\Jobs\SendEventNotification;
use App\Traits\HasCacheTrait;

class ParticipantObserver
{
    use HasCacheTrait;
    /**
     * Handle the Participant "created" event.
     */
    public function created(Participant $participant): void
    {
        $this->forgetCache('participants.all');
        // $participant->load('events');

        // if($participant->events)
        // {
        //     foreach($participant->events as $event)
        //     {
        //         SendEventNotification::dispatch($event, $participant)->onQueue('mail');
        //     }           
        // }        
    }

    /**
     * Handle the Participant "updated" event.
     */
    public function updated(Participant $participant): void
    {
        $this->forgetCache('participants.all');
    }

    /**
     * Handle the Participant "deleted" event.
     */
    public function deleted(Participant $participant): void
    {
        $this->forgetCache('participants.all');
    }

    /**
     * Handle the Participant "restored" event.
     */
    public function restored(Participant $participant): void
    {
        //
    }

    /**
     * Handle the Participant "force deleted" event.
     */
    public function forceDeleted(Participant $participant): void
    {
        //
    }
}
