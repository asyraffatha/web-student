<?php
// database/seeders/AdminSeeder.php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Cek apakah admin sudah ada
        if (!User::where('role', 'admin')->exists()) {
            User::create([
                'name' => 'Super Administrator',
                'email' => 'admin@mathporia.my.id',
                'password' => Hash::make('mathporia123'), // Ganti dengan password yang kuat
                'role' => 'admin',
                'is_active' => true,
                'email_verified_at' => now(),
            ]);

            echo "Admin user created successfully!\n";
            echo "Email: admin@mathporia.my.id\n";
            echo "Password: mathporia123\n";
        } else {
            echo "Admin user already exists!\n";
        }
    }
}