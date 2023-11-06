<?php

namespace Database\Factories\Project;

use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\Project\Product;
use App\Models\Project\Category;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Project\Product>
 */
class MediaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
		$src = $this->src();
        return [
			'src_max' => $src['max'],
			'src_average' => $src['average'],
			'src_min' => $src['min'],
			'product_id' => Product::get()->random()->id,
        ];
    }
	public function src()
	{
		$imageUrl = fake()->imageUrl();

		return [
			'max' => $imageUrl,
			'average' => $imageUrl,
			'min' => $imageUrl
		];
	}
}
