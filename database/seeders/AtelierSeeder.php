<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AtelierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('Studio')->insert([
            ['name' => 'Photography Studio', 'location' => 'Building A'],
            ['name' => 'Sound Studio', 'location' => 'Building B'],
        ]);
    }
}
