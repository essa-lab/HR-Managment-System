<?php
namespace App\Repositories;
use App\Models\Position;

class PositionRepository extends Repository{
    public function __construct(Position $position){
        parent::__construct($position);
    }
}
?>
