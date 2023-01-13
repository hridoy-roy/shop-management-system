<?php

namespace Database\Factories;

use App\Models\Customer;
use App\Utility\Utility;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SaleReturn>
 */
class SaleReturnFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'sale_return_num' => fake()->numberBetween(),
            'date' => fake()->dateTimeBetween('-2 month','+2 month'),
            'amount' => fake()->numberBetween(100,300),
            'type' => fake()->randomElement(Utility::$type),
            'created_by' => 'Admin Seeder'
        ];
    }
}
