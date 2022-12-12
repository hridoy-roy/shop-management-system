<?php

namespace Database\Factories;

use App\Models\ProductCategory;
use App\Utility\Utility;
use Illuminate\Database\Eloquent\Factories\Factory;

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
    public function definition()
    {
        return [
            'name' => fake()->name(),
            'product_category_id' => ProductCategory::inRandomOrder()->first()->id,
            'unit_name' => array_rand(Utility::$units),
            'price' => rand(80, 100),
            'created_by' => "Admin",
            'updated_by' => "Admin",
        ];
    }
}
