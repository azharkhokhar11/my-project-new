<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Venue;
use Faker\Guesser\Name;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Event>
 */
class EventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->unique()->word,
            'description' => fake()->paragraph,
            'date' => fake()->date,
            'user_id' => User::factory()
        ];
    }
}
