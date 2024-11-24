<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LoansSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('Loans')->insert([
            [
                'user_id' => 1,
                'device_id' => 3,
                'issue_date' => '2024-11-20 09:00:00',
                'return_date' => '2024-11-21 16:00:00',
                'time_from' => '09:00:00',
                'time_to' => '16:00:00',
                'status' => 'Loaned',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 2,
                'device_id' => 2,
                'issue_date' => '2024-11-18 10:00:00',
                'return_date' => '2024-11-19 14:00:00',
                'time_from' => '10:00:00',
                'time_to' => '14:00:00',
                'status' => 'Returned',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
