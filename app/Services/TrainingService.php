<?php
namespace App\Services;
use App\Repositories\TrainingRepository;

class TrainingService extends Service{
    public function __construct(TrainingRepository $trainingRepository){
        parent::__construct($trainingRepository);
    }
}
?>
