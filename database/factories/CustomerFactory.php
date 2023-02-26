<?php

namespace Database\Factories;

use App\Models\Customer;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Customer>
 */
class CustomerFactory extends Factory
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
            'address' => fake()->address(),
            'joining_date' => fake()->dateTimeBetween(),
            'rating' => fake()->numberBetween(1,5),
            'phone' => fake()->PhoneNumber(),
            'email' => fake()->safeEmail(),
            'created_by' => 'Admin Seeder',
        ];
    }
}
