<?php
namespace App\Repositories;
use App\Models\Department;

class DepartmentRepository extends Repository{
    public function __construct(Department $department){
        parent::__construct($department);
    }
}
?>
