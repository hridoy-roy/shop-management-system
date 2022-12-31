<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PurchaseReturn>
 */
class PurchaseReturnFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'purchase_return_num' => fake()->numberBetween(),
            'date' => fake()->dateTimeBetween('-2 month','+2 month'),
            'amount' => fake()->numberBetween(100,300),
            'type' => 'Cash',
            'created_by' => 'Admin Seeder'
        ];
    }
}
