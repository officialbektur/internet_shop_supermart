<?php

namespace Database\Factories\Project;

use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\Project\Specification;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Project\Specification>
 */
class SpecificationFactory extends Factory
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
	public function configure()
	{
		return $this->afterCreating(function (Specification $specification) {
			if ($specification->parent_id === '0') {
				$childSpecificationsCount = random_int(1, 5);
				Specification::factory()
					->count($childSpecificationsCount)
					->create([
						'parent_id' => $specification->id
					]);
			}
		});
	}
}
