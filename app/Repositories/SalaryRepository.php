<?php
namespace App\Repositories;
use App\Models\Salary;

class SalaryRepository extends Repository{
    public function __construct(Salary $salary){
        parent::__construct($salary);
    }
}
?>
