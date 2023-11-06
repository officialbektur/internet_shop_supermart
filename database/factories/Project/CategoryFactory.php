<?php

namespace Database\Factories\Project;

use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\Project\Category;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Project\Category>
 */
class CategoryFactory extends Factory
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
			'parent_id' => '0'
		];
	}
	public function parentRandom($category)
	{
		$random = random_int(0, 10);
		$parentId = '';

		if (Category::count() > 0 && $random > 1) {
			$newParentId = Category::get()->random()->id;
			if ($category > $newParentId) {
				$parentId = $newParentId;
			} else {
				$parentId = $this->parentRandom($category);
			}
		} else {
			$parentId = '0';
		}
		return $parentId;
	}
	public function configure()
	{
		return $this->afterCreating(function (Category $category) {
			$category->update(['parent_id' => $this->parentRandom($category->id)]);
		});
	}
}
