<?php
namespace App\Services;
use App\Repositories\SalaryRepository;

class SalaryService extends Service{
    public function __construct(SalaryRepository $salaryRepository){
        parent::__construct($salaryRepository);
    }
}
?>
