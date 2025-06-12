<?php

namespace App\Providers;

use App\Events\EventCreated;
use App\Listeners\SendEventCreatedEmail;
use App\Models\Participant;
use App\Observers\ParticipantObserver;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Event;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Participant::observe(ParticipantObserver::class);

        Event::listen(EventCreated::class, SendEventCreatedEmail::class);
    }
}
