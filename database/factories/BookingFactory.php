<?php

namespace Database\Factories;

use App\Models\Venue;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Booking>
 */
class BookingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $guests = fake()->numberBetween(100, 300);
        $pricePerGuest = 1000;
        return [
            'booking_date' => fake()->date(),        
            'number_of_guest' => $guests,
            'total_amount' => $guests * $pricePerGuest,            
            'status' => fake()->randomElement(['pending', 'confirmed', 'cancelled']),
        ];
    }
}
