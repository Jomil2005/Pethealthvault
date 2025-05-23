<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    public function run()
    {
        Role::create([
            'role_id' => 1,
            'name' => 'Admin',
            'description' => 'Administrator role',
        ]);
    }
}
