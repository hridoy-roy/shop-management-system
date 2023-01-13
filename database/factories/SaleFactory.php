<?php

namespace Database\Factories;

use App\Models\Customer;
use App\Utility\Utility;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Sale>
 */
class SaleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'sale_num' => fake()->numberBetween(),
            'customer_id' => Customer::all()->random()->id,
            'date' => fake()->dateTimeBetween('-2 month','+2 month'),
            'amount' => fake()->numberBetween(100,300),
            'discount' => fake()->numberBetween(10,30),
            'type' => fake()->randomElement(Utility::$type),
            'created_by' => 'Admin Seeder'
        ];
    }
}
