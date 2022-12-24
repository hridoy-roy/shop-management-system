<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Purchase>
 */
class PurchaseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'purchase_num' => fake()->numberBetween(),
            'date' => fake()->date('Y-m-d'),
            'amount' => fake()->numberBetween(100,300),
            'type' => 'Checked',
            'created_by' => 'Admin Seeder'
        ];
    }
}
