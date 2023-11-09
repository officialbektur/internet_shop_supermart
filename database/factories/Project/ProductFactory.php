<?php

namespace Database\Factories\Project;

use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\Project\Product;
use App\Models\Project\Category;
use App\Models\Project\Description;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Project\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
		$price_old = random_int(0, 10) > 6 ? random_int(0, 9999) : '0';
		$titleRandomCount = random_int(1, 3);
        return [
			'title' => fake()->sentence($titleRandomCount),
			'price_old' => $price_old,
			'price_now' => random_int(1, 9999),
			'category_id' => Category::get()->random()->id,
			'hit' => random_int(0, 1),
        ];
    }
}
