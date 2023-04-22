<?php
namespace App\Services;
use App\Repositories\EmployeeRepository;

class EmployeeService extends Service{
    public function __construct(EmployeeRepository $employeeRepository){
        parent::__construct($employeeRepository);
    }
}
?>
