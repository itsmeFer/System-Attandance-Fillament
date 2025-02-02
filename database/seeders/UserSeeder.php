<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => bcrypt('password123'),
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'Manager User',
            'email' => 'manager@example.com',
            'password' => bcrypt('password123'),
            'role' => 'manager',
        ]);

        User::create([
            'name' => 'Karyawan User',
            'email' => 'karyawan@example.com',
            'password' => bcrypt('password123'),
            'role' => 'karyawan',
        ]);
    }
}
