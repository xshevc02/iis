<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        // Call individual seeders here
        $this->call([
            DeviceTypesSeeder::class, // Seeder for Device_Types table
            RoleSeeder::class,         //Seeder for Roles table (if exists)
            UsersSeeder::class,
            AtelierSeeder::class,      // Seeder for Studios table (if exists)
            DevicesSeeder::class,
            LoansSeeder::class,
            ReservationsSeeder::class]);
    }
}
