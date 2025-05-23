<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'firstname' => 'Ylana',
            'lastname' => 'Aleria',
            'email' => 'aleanalyn15@gmail.com',
            'password' => Hash::make('alialiali'), // Secure password hashing
            'role_id' => 1
        ]);
    }
}
