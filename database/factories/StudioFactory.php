<?php

namespace Database\Factories;

use App\Models\Studio;
use Illuminate\Database\Eloquent\Factories\Factory;

class StudioFactory extends Factory
{
    protected $model = Studio::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->words(2, true), // Generate a two-word studio name
            'location' => $this->faker->address(), // Generate a random location
        ];
    }
}
