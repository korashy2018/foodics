<?php

namespace Database\Factories;

use App\Domains\Ingredients\Models\Ingredient;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Ingredient>
 */
class IngredientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'expiry_date' => Carbon::addWeeks(40),
            'notification_sent' => false,
            'name' => $this->faker->word(),
        ];
    }
}
