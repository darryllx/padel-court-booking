<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BookingSeeder extends Seeder
{
    public function run(): void
    {
        // Contoh: Customer (ID 2) membooking Lapangan Indoor (ID 1)
        DB::table('bookings')->insert([
            'user_id' => 2,
            'court_id' => 1,
            'status' => 'Confirmed', // Status pemesanan: Pending, Confirmed, Cancelled, Completed
            'booking_date' => now()->addDays(1)->toDateString(),
            'start_time' => '14:00:00',
            'end_time' => '16:00:00',
            'total_price' => 300000, // 2 jam * 150rb
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}