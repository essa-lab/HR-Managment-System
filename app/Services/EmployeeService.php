<?php
namespace App\Services;
use App\Models\Employee;
use App\Repositories\EmployeeRepository;

class EmployeeService extends Service{
    public function __construct(EmployeeRepository $employeeRepository){
        parent::__construct($employeeRepository);
    }

    public function assignEmployeeToDepartment(Employee $employee,$deparmentId){
        $employee->department_id = $deparmentId;
        $employee->save();
    }
    public function assignPositionToEmployee(Employee $employee,$positionId){
        $employee->position_id = $positionId;
        $employee->save();
    }
    public function retrieveSalaryInformation(Employee $employee){
        $salary = $employee->salary;
        if($salary){
            $res = [
                'amount'=>$salary->base_salary,
                'commision'=>$salary->commision,
                'effective_data'=>$salary->effective_data
            ];
            return $res;
        }
        return null;
    }

}
?>
