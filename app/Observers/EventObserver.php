<?php

namespace App\Observers;

use App\Models\Event;
use App\Traits\HasCacheTrait;

class EventObserver
{
    use HasCacheTrait;
    /**
     * Handle the Event "created" event.
     */
    public function created(Event $event): void
    {
        $this->forgetCache('events.all');
    }

    /**
     * Handle the Event "updated" event.
     */
    public function updated(Event $event): void
    {
        $this->forgetCache('events.all');
    }

    /**
     * Handle the Event "deleted" event.
     */
    public function deleted(Event $event): void
    {
        $this->forgetCache('events.all');
    }

    /**
     * Handle the Event "restored" event.
     */
    public function restored(Event $event): void
    {
        //
    }

    /**
     * Handle the Event "force deleted" event.
     */
    public function forceDeleted(Event $event): void
    {
        //
    }
}
