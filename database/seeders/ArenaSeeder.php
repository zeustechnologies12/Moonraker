<?php

namespace Database\Seeders;

use App\Models\Arena;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ArenaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Arena::factory()->create([
            'name' => 'Great Town Arena',
            'price' => 5000,
            'location_id' => 1,
        ]);
        Arena::factory()->create([
            'name' => 'Mountain Peak Arena',
            'price' => 7500,
            'location_id' => 2,
        ]);
        Arena::factory()->create([
            'name' => 'City Center Arena',
            'price' => 3000,
            'location_id' => 3,
        ]);
        Arena::factory()->create([
            'name' => 'Suburban Arena',
            'price' => 4500,
            'location_id' => 2,
        ]);
        Arena::factory()->create([
            'name' => 'Championship Arena',
            'price' => 10000,
            'location_id' => 1,
        ]);
    }
}
