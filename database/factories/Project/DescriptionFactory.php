<?php

namespace Database\Factories\Project;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Project\Description;
use App\Models\Project\Product;

class DescriptionFactory extends Factory
{
    public function definition(): array
    {
        $len = $this->faker->numberBetween(50, 300);
        return [
            'info' => $this->faker->text($len),
            'product_id' => 0,
        ];
    }

	public function productId()
	{
		$product = Product::get()->random()->id;
		$description = Description::where('product_id', $product)->get();
		if (!isset($description)) {
			$this->productId();
		}
		return $product;
	}
	public function configure()
    {
        return $this->afterCreating(function (Description $description) {
            $description->update(['product_id' => $this->productId()]);
        });
    }
}