<?php

namespace Database\Seeders;

use App\Models\Booking;
use App\Models\Event;
use App\Models\Venue;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $venues = Venue::factory()->count(10)->create()->pluck('id');

        Event::factory()->count(10)->make()->each(function ($event) use ($venues) {
            $event->venue_id = $venues->random();
            $event->save();
        });

        Booking::factory()->count(10)->make()->each(function ($booking) use ($venues) {
                $booking->venue_id = $venues->random();
                $booking->save();
        });
    }
}