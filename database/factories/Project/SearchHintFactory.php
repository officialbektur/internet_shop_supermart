<?php

namespace Database\Factories\Project;

use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\Project\SearchHint;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Project\Category>
 */
class SearchHintFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
			'name' => fake()->word,
        ];
    }
}
