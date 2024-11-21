<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DeviceTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('Device_Types')->insert([
            ['type_name' => 'Camera'],
            ['type_name' => 'Camcorder'],
            ['type_name' => 'Microphone'],
            ['type_name' => 'Laptop'],
        ]);
    }
}
