<?php
namespace App\Services;
use App\Repositories\DepartmentRepository;

class DepartmentService extends Service{
    public function __construct(DepartmentRepository $departmentRepository){
        parent::__construct($departmentRepository);
    }
}
?>
