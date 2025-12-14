<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CourtCategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = ['Indoor', 'Outdoor', 'Semi Outdoor'];

        foreach ($categories as $cat) {
            DB::table('court_categories')->insert([
                'category_name' => $cat,
                'description' => 'Deskripsi untuk lapangan ' . $cat,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}