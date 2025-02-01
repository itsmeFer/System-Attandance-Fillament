<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserRoleSeeder extends Seeder
{
    public function run()
    {
        // Membuat akun pengguna baru
        $user = User::create([
            'name' => 'Admin User', // Nama pengguna
            'email' => 'admin@example.com', // Email pengguna
            'password' => bcrypt('password'), // Password (gunakan bcrypt untuk mengenkripsi password)
        ]);

        // Menetapkan role admin ke pengguna yang baru dibuat
        $user->assignRole('admin');
    }
}
