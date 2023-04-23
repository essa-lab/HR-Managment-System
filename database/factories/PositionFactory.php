<?php

namespace Database\Factories;
use App\Models\Department;
use App\Models\Position;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Position>
 */
class PositionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Position::class;
    public function definition()
    {
        $department = Department::all();
        return [
            'name'=>$this->faker->jobTitle(),
            'job_description'=>$this->faker->text(100),
            'department_id'=>$department->random()->id,
            'job_requirment'=>$this->faker->text()
            //
        ];
    }
}
