<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ToyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'category_id' => mt_rand(1, 3),
            'name' => fake()->sentence(mt_rand(1,3)),
            'description' =>fake()->paragraph(),
            'price' => mt_rand(10000, 100000),
            'stock' => mt_rand(1, 9999),
            'image' => ''
        ];
    }
}
