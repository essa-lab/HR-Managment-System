<?php
namespace App\Services;
use App\Repositories\ReviewRepository;

class ReviewService extends Service{
    public function __construct(ReviewRepository $reviewRepository){
        parent::__construct($reviewRepository);
    }
}
?>
