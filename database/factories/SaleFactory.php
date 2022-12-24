<?php

namespace Database\Factories;

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
            'date' => fake()->date('Y-m-d'),
            'amount' => fake()->numberBetween(100,300),
            'type' => 'Checked',
            'created_by' => 'Admin Seeder'
        ];
    }
}
