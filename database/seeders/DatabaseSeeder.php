<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Seed Roles menggunakan factory
        $roleAdmin = \App\Models\Role::factory()->admin()->create();
        $roleMember = \App\Models\Role::factory()->member()->create();

        // Akun Admin Dummy menggunakan factory
        User::factory()->create([
            'name' => 'Administrator',
            'email' => 'admin@example.com',
            'username' => 'admin',
            'password' => Hash::make('Admin123'),
            'role_id' => $roleAdmin->id,
        ]);

        // Akun Member Dummy menggunakan factory
        User::factory()->create([
            'name' => 'Member Demo',
            'email' => 'member@example.com',
            'username' => 'member',
            'password' => Hash::make('Member123'),
            'role_id' => $roleMember->id,
        ]);

        // Generate 5 member tambahan untuk testing (opsional)
        User::factory(5)->create([
            'role_id' => $roleMember->id,
        ]);
    }
}
