<?php

namespace Database\Factories\Project\App;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Project\Product>
 */
class PlanWorkFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
			'mode' => 'с Понедельника до Пятницы',
			'hours' => 'с 10:00 до 19:00',
        ];
    }
}
