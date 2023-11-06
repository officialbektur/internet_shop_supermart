<?php

namespace Database\Factories\Project;

use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\Project\Product;
use App\Models\Project\Category;
use App\Models\Project\Description;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Project\Product>
 */
class CommentaryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
		$textCount = random_int(5, 255);
		return [
			'product_id' => Product::get()->random()->id,
			'name' => fake()->name,
			'rating' => random_int(1, 5),
			'message' => fake()->text($textCount),
        ];
    }
}
