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
            'price' => 5000, // Set a fixed price or use random
            'location_id' => 1, // Assign to location_id 1
        ]);
    }
}
