<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DevicesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('Device')->insert([
            [
                'name' => 'Canon EOS 5D',
                'year_of_manufacture' => 2019,
                'purchase_date' => '2020-03-15',
                'max_loan_duration' => 3,
                'available' => true,
                'type_id' => 1, // Assuming type_id 1 corresponds to "Camera"
                'studio_id' => 1, // Assuming studio_id 1 corresponds to "Photography Studio"
                'user_id' => 2, // Assuming user_id 2 corresponds to "Studio Manager"
            ],
            [
                'name' => 'Sony PXW-X70',
                'year_of_manufacture' => 2018,
                'purchase_date' => '2019-05-20',
                'max_loan_duration' => 5,
                'available' => true,
                'type_id' => 2, // Assuming type_id 2 corresponds to "Camcorder"
                'studio_id' => 1, // Photography Studio
                'user_id' => 2, // Studio Manager
            ],
            [
                'name' => 'Shure SM7B',
                'year_of_manufacture' => 2021,
                'purchase_date' => '2022-02-10',
                'max_loan_duration' => 7,
                'available' => true,
                'type_id' => 3, // Assuming type_id 3 corresponds to "Microphone"
                'studio_id' => 2, // Sound Studio
                'user_id' => 3, // Instructor
            ],
        ]);
    }
}
