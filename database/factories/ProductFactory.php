<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Category;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
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
        // convertir el nombre en una cadena
        $name = fake()->words(2, true);
        $imageUlr = Str::replace(' ', '+', $name);
        return [
            'category_id'=>Category::factory(),
            'name' => $name,
            'description'=>fake()->paragraph(),
            'price'=>fake()->randomFloat(2, 5, 500),
            'rating'=>fake()->randomFloat(1, 1, 5),
            'stock'=>fake()->numberBetween(10, 200),
            'quantity_sold'=>fake()->numberBetween(0, 200),
            'featured_image'=>"https://placehold.co/600x400/orange/white?text=$imageUlr"
        ];
    }
}
