<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CourtImageSeeder extends Seeder
{
    public function run(): void
    {
        // Dummy gambar untuk lapangan ID 1, 2, dan 3
        DB::table('court_images')->insert([
            ['court_id' => 1, 'image_path' => 'courts/indoor-1.jpg', 'created_at' => now(), 'updated_at' => now()],
            ['court_id' => 2, 'image_path' => 'courts/outdoor-1.jpg', 'created_at' => now(), 'updated_at' => now()],
            ['court_id' => 3, 'image_path' => 'courts/semi-outdoor-1.jpg', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}