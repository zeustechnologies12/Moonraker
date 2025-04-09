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
        foreach (SportNamesEnum::cases() as $sport) {
            Sport::firstOrCreate(['name' => $sport->value]);
        }
    }
}
