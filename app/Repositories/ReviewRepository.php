<?php
namespace App\Repositories;
use App\Models\Review;

class ReviewRepository extends Repository{
    public function __construct(Review $review){
        parent::__construct($review);
    }
}
?>
