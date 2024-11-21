<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Reservation>
 */
class ReservationFactory extends Factory
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
            'reservation_date' => fake()->dateTimeBetween('-1 month', '+1 week'),
            'duration' => fake()->numberBetween(1, 7), // Duration in days
            'status' => fake()->randomElement(['Pending', 'Approved', 'Declined']),
        ];
    }
}
