<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    public function run()
    {
        // Insert Admin with fixed ID 1
        if (!Role::where('role_id', 1)->exists()) {
            Role::create([
                'role_id' => 1,
                'name' => 'Admin',
                'description' => 'Administrator role',
            ]);
        }

        // Insert Pet Owner with fixed ID 2
        if (!Role::where('role_id', 2)->exists()) {
            Role::create([
                'role_id' => 2,
                'name' => 'Pet Owner',
                'description' => 'Pet Owner role',
            ]);
        }
    }
}
