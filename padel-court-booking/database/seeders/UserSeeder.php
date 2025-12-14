<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Akun Admin
        DB::table('users')->insert([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin123'), // Password: admin123
            'role' => 'admin',
            'phone_number' => '081234567890',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // 2. Akun Customer (Penyewa)
        DB::table('users')->insert([
            'name' => 'Budi Santoso',
            'email' => 'budi@gmail.com',
            'password' => Hash::make('password123'),
            'role' => 'customer',
            'phone_number' => '089876543210',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}