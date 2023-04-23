<?php

namespace Database\Factories;
use App\Models\Employee;
use App\Models\Position;
use App\Models\Department;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Employee>
 */
class EmployeeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Employee::class;
    public function definition()
    {

        return [
            'first_name'=>$this->faker->firstName(),
            'last_name'=>$this->faker->lastName(),
            'birth_date'=>$this->faker->date(),
            'email'=>$this->faker->unique()->safeEmail(),
            'phone_number'=>$this->faker->phoneNumber(),
            'hire_date'=>$this->faker->dateTimeBetween('-1 year','now'),

        ];
    }
}
