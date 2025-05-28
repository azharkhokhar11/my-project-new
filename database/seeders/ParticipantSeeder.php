<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\Participant;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ParticipantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $events = Event::all();

    Participant::factory(10)->create()->each(function ($participant) use ($events) {
    $participant->events()->attach(
        $events->random(rand(1, 3))->pluck('id')->toArray()
    );
});
    }
}
