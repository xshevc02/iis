<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReservationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('Reservations')->insert([
            [
                'user_id' => 1,
                'device_id' => 1,
                'reservation_date' => '2024-11-15 12:00:00',
                'duration' => 2,
                'status' => 'Pending',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 3,
                'device_id' => 2,
                'reservation_date' => '2024-11-16 14:00:00',
                'duration' => 3,
                'status' => 'Approved',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
