<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class employeesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            //
            'name' => fake()->name,
            'age' => fake()->numberBetween(20,50),
            'email'=>fake()->unique()->email,
            'hire_date'=>fake()->dateTime(),
            'gender'=>fake()->randomElement(['male','female'])
        ];
    }
}
