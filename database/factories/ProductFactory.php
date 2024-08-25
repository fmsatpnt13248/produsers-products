<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator as Faker;

use App\Models\Product;
use App\Models\Producer;
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
    protected $model = Product::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'detail' => $this->faker->sentence,
            'price' => $this->faker->randomFloat(2, 10, 100),
            'amount' => $this->faker->numberBetween(1, 100),
            'producer_id' => Producer::factory()
        ];
    }
}
