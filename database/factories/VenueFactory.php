<?php

namespace Database\Factories;

use App\Models\Venue;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Venue>
 */
class VenueFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->company,
            'address' => fake()->address,
            'phone_number' => fake()->phoneNumber,
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (Venue $venue) {
            \App\Models\Image::factory()->count(3)->create([
                'imageable_id' => $venue->id,
                'imageable_type' => Venue::class,
            ]);
        });
    }
}
