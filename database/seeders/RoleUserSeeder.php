<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::first();
        $roles = Role::all(); // get all roles

        if ($user && $roles->count()) {
            $user->roles()->syncWithoutDetaching($roles->pluck('id'));
        }
    }
}
