<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class EmployeeSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name' => 'Karyawan 1',
            'email' => 'karyawan1@example.com',
            'password' => Hash::make('password123'), // Ubah sesuai kebutuhan
            'role' => 'karyawan',
        ]);
    }
}
