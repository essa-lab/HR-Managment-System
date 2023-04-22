<?php
namespace App\Repositories;
use App\Models\Training;

class TrainingRepository extends Repository{
    public function __construct(Training $training){
        parent::__construct($training);
    }
}
?>
