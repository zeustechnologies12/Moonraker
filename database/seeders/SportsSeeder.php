<?php

namespace Database\Seeders;

use App\Enums\SportNamesEnum;
use App\Models\Sport;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SportsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sports = [
            ['name' => SportNamesEnum::Futsal->value,  'players' => '5'],
            ['name' => SportNamesEnum::Futsal->value,  'players' => '7'],
            ['name' => SportNamesEnum::Cricker->value, 'players' => '7'],
        ];

        foreach ($sports as $sport) {
            Sport::firstOrCreate($sport);
        }
    }
}
