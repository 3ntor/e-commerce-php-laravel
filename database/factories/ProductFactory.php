<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => $this->faker->word(),
            'description' => $this->faker->sentence(8),
            'price' => $this->faker->randomFloat(2, 50, 500),
            'image' => 'https://via.placeholder.com/150',
            'category_id' => 1, // هيتعدل في Seeder
        ];
    }
}
