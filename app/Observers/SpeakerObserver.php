<?php

namespace App\Observers;

use App\Models\Speaker;
use App\Traits\HasCacheTrait;

class SpeakerObserver
{
    use HasCacheTrait;
    /**
     * Handle the Speaker "created" event.
     */
    public function created(Speaker $speaker): void
    {
        $this->forgetCache('speakers.all');
    }

    /**
     * Handle the Speaker "updated" event.
     */
    public function updated(Speaker $speaker): void
    {
        $this->forgetCache('speakers.all');
    }

    /**
     * Handle the Speaker "deleted" event.
     */
    public function deleted(Speaker $speaker): void
    {
        $this->forgetCache('speakers.all');
    }

    /**
     * Handle the Speaker "restored" event.
     */
    public function restored(Speaker $speaker): void
    {
        //
    }

    /**
     * Handle the Speaker "force deleted" event.
     */
    public function forceDeleted(Speaker $speaker): void
    {
        //
    }
}
