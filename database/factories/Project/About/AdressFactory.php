<?php

namespace Database\Factories\Project\About;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Project\Product>
 */
class AdressFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
			'map' => fake()->imageUrl(),
			'href' => fake()->imageUrl(),
			'title' => fake()->address,
        ];
    }
}
