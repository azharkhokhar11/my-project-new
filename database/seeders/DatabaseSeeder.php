<?php

namespace Database\Seeders;

use App\Models\Booking;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Event;
use App\Models\Image;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
       // User::factory()->count(10)->create();
        
        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call([
            EventSeeder::class,
            ParticipantSeeder::class,
            SpeakerSeeder::class,
        ]);
        // Booking::factory()->count(10)->create();
        // Image::factory()->count(10)->create();



    }
}
