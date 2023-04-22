<?php
namespace App\Services;
use App\Repositories\PositionRepository;

class PositionService extends Service{
    public function __construct(PositionRepository $positionRepository){
        parent::__construct($positionRepository);
    }
}
?>
