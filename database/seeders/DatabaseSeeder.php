<?php

namespace Database\Seeders;

use App\Models\Department;
use App\Models\Position;
use App\Models\Employee;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Employee::factory(100)->create();

        $employees = Employee::all();

        // create 10 departments
        Department::factory(10)->create()->each(function ($department) use ($employees) {
            // assign a random employee as manager for the department
            $department->manager_id = $employees->random()->id;
            $department->save();
        });


        $departments = Department::all();

        // create 50 positions
        Position::factory(10)->create()->each(function ($position) use ($departments) {
            // assign a random department to the position
            $position->department_id = $departments->random()->id;
            $position->save();
        });


                // Get all the departments and positions
        $departments = Department::all();
        $positions = Position::all();

        // Loop through each employee and update the department_id and position_id attributes
        foreach (Employee::all() as $employee) {
          // Get a random department and position
             $department = $departments->random();
             $position = $positions->random();

              // Update the employee's department_id and position_id attributes
             $employee->update([
             'department_id' => $department->id,
             'position_id' => $position->id,
             ]);


        }
    }
}
