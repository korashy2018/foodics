<?php

namespace Database\Factories;

use App\Domains\Product\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Product>
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
        return [
            'name' => $this->faker->word(),
            'notification_sent' => false,
            'price' => $this->faker->randomNumber(3)
        ];
    }
}
