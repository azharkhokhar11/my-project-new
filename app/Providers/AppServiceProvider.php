<?php

namespace App\Providers;

use App\Models\Participant;
use App\Events\EventCreated;
use Illuminate\Support\Facades\Event;
use App\Observers\ParticipantObserver;
use App\Repositories\SpeakerRepository;
use Illuminate\Support\ServiceProvider;
use App\Listeners\SendEventCreatedEmail;
use App\Repositories\ParticipantRepository;
use App\Repositories\SpeakerRepositoryInterface;
use App\Repositories\ParticipantRepositoryInterface;
use App\Repositories\EventRepository;
use App\Repositories\EventRepositoryInterface;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(ParticipantRepositoryInterface::class, ParticipantRepository::class);
        $this->app->bind(SpeakerRepositoryInterface::class, SpeakerRepository::class);
         $this->app->bind(EventRepositoryInterface::class, EventRepository::class);

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
