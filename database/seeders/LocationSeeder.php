<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\Location;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $locations = ['Model Town', 'Faisal Town', 'Johar Town'];

        foreach ($locations as $location) {
            Location::factory()->create([
                'name' => $location,
                'city_id' => 1,
            ]);
        }
    }
}
