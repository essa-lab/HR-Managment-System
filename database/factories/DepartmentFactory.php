<?php

namespace Database\Factories;

use App\Models\Department;
use App\Models\Employee;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Department>
 */
class DepartmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model=Department::class;
    public function definition()
    {
        $employee = Employee::all();
        return [
            //
            'name'=>$this->faker->domainName(),
            'location'=>$this->faker->address(),
            'budget'=>$this->faker->numberBetween(0,10000),
            'manager_id'=>$employee->random()->id
        ];
    }
}
