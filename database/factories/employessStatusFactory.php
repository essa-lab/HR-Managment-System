<?php

namespace Database\Factories;

use App\Http\Resources\employee;
use App\Models\employees;
use App\Models\jobs;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class employessStatusFactory extends Factory
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
            'salary'=>fake()->numberBetween(500,5000),
            'emp_id'=> function () {
                return employees::factory()->create()->id;
            },
            'job_id'=>function () {
                return jobs::factory()->create()->id;
            },
            'manager_id'=>function () {
                return employees::factory()->create()->id;
            },
        ];
    }
}
