<?php

namespace Database\Factories\Project\App;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Project\Product>
 */
class EmailFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
		$email = fake()->unique()->safeEmail;
        return [
			'href' => $email,
			'email' => $email,
        ];
    }
}
