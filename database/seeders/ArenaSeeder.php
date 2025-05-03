<?php

namespace Database\Seeders;

use App\Models\Arena;
use App\Models\City;
use App\Models\Location;
use Illuminate\Database\Seeder;

class ArenaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $arenas_by_city = [
            'Lahore' => [
                ['name' => 'great_town_arena', 'price' => 5000],
                ['name' => 'championship_arena', 'price' => 10000],
                ['name' => 'model_arena', 'price' => 4000],
            ],
            'Karachi' => [
                ['name' => 'mountain_peak_arena', 'price' => 7500],
                ['name' => 'suburban_arena', 'price' => 4500],
                ['name' => 'ocean_view_arena', 'price' => 8000],
            ],
            'Islamabad' => [
                ['name' => 'city_center_arena', 'price' => 3000],
                ['name' => 'skyline_arena', 'price' => 7000],
                ['name' => 'hilltop_arena', 'price' => 6200],
            ],
        ];

        foreach ($arenas_by_city as $city_name => $arenas) {
            $city = City::where('name', $city_name)->first();
            if (!$city) {
                continue;
            }

            $location_ids = $city->locations()->pluck('id')->toArray();

            foreach ($arenas as $arena_data) {
                Arena::factory()->create([
                    'name' => $arena_data['name'],
                    'price' => $arena_data['price'],
                    'location_id' => $location_ids[array_rand($location_ids)],
                ]);
            }
        }
    }
}
