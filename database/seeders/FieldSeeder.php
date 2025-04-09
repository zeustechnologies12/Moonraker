<?php

namespace Database\Seeders;

use App\Models\Field;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FieldSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $arena_ids = [1, 2];
        $sport_ids = [1, 2, 3];

        foreach ($arena_ids as $arena_id) {
            foreach ($sport_ids as $sport_id) {
                Field::firstOrCreate([
                    'arena_id' => $arena_id,
                    'sport_id' => $sport_id,
                ]);
            }
        }
    }
}
