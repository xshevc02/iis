<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Disable foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // Truncate the table
        DB::table('users')->truncate();

        // Enable foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        DB::table('users')->insert([
            [
                'username' => 'admin',
                'name' => 'System Administrator',
                'email' => 'admin@example.com',
                'password' => bcrypt('password'), // Use bcrypt for hashing
                'role_id' => 1, // Administrator role
                'studio_id' => null, // No specific studio
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'username' => 'studio_manager',
                'name' => 'John Studio Manager',
                'email' => 'manager@example.com',
                'password' => bcrypt('password'),
                'role_id' => 2, // Studio Manager role
                'studio_id' => 1, // Photography Studio
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'username' => 'instructor',
                'name' => 'Anna Instructor',
                'email' => 'instructor@example.com',
                'password' => bcrypt('password'),
                'role_id' => 3, // Instructor role
                'studio_id' => 2, // Sound Studio
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
