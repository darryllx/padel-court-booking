<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $adminRole = \App\Models\Role::where('name', 'admin')->first();
        $customerRole = \App\Models\Role::where('name', 'customer')->first();

        // 1. Akun Admin
        DB::table('users')->insert([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin123'), // Password: admin123
            'role_id' => $adminRole->id,
            'phone_number' => '081234567890',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // 2. Akun Customer (Penyewa)
        DB::table('users')->insert([
            'name' => 'Budi Santoso',
            'email' => 'budi@gmail.com',
            'password' => Hash::make('password123'),
            'role_id' => $customerRole->id,
            'phone_number' => '089876543210',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}