<?php

namespace Database\Factories;

use App\Models\Location;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Arena>
 */
class ArenaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->company(), // Generates a random name for the arena
            'price' => fake()->randomFloat(2, 1000, 10000), // Generates a random price between 1000-10000
            'location_id' => Location::inRandomOrder()->first()->id ?? Location::factory(), // Assign a random location
        ];
    }
}
