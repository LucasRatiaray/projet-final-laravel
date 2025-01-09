<?php

namespace Database\Factories;

use App\Faker\FurnitureProvider;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Product;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    protected $model = Product::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $this->faker->addProvider(new FurnitureProvider($this->faker));

        return [
            'name' => $this->faker->meubleName(),
            'description' => $this->faker->sentence(),
            'price' => $this->faker->randomFloat(2, 10, 1000),
            'in_stock' => $this->faker->boolean(),
            'width' => $this->faker->numberBetween(10, 200),
            'height' => $this->faker->numberBetween(10, 200),
            'depth' => $this->faker->numberBetween(10, 200),
        ];
    }
}
