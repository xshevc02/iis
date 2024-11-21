<?php

namespace Database\Factories;

use App\Models\Device;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Device>
 */
class DeviceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->word(),
            'type_id' => fake()->numberBetween(1, 5), // Adjust based on your device types
            'studio_id' => fake()->numberBetween(1, 3), // Adjust based on your studios
            'user_id' => fake()->numberBetween(1, 10), // Assuming users exist
            'year_of_manufacture' => fake()->year(),
            'purchase_date' => fake()->date(),
            'max_loan_duration' => fake()->numberBetween(1, 14), // Max loan duration in days
            'available' => fake()->boolean(),
        ];
    }
}
