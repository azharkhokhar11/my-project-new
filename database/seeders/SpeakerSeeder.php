<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\Speaker;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SpeakerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $events = Event::all();

    Speaker::factory()->count(10)->create()->each(function ($speaker) use ($events) {
    $speaker->events()->attach(
        $events->random(rand(1, 3))->pluck('id')->toArray()
    );
});
    }
}
