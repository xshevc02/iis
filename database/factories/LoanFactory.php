<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Loan>
 */
class LoanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => fake()->numberBetween(1, 10), // Adjust based on your users
            'device_id' => fake()->numberBetween(1, 20), // Adjust based on your devices
            'issue_date' => fake()->dateTimeBetween('-1 month', 'now'),
            'return_date' => fake()->optional()->dateTimeBetween('now', '+1 month'),
            'time_from' => fake()->time(),
            'time_to' => fake()->time(),
            'status' => fake()->randomElement(['Loaned', 'Returned', 'Overdue']),
        ];
    }
}
