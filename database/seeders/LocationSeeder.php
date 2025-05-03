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
        $cities = [
            'Lahore' => ['Model Town', 'Faisal Town', 'Johar Town'],
            'Karachi' => ['DHA', 'Gulistan-e-johar', 'Nazimabad'],
            'Islamabad' => ['gulberg', 'faisal colony', 'DHA'],
        ];

        foreach ($cities as $city_name => $location_names) {
            $city = City::whereName($city_name)->first();

            foreach ($location_names as $location_name) {
                Location::factory()->create([
                    'name' => $location_name,
                    'city_id' => $city->id,
                ]);
            }
        }
    }
}
