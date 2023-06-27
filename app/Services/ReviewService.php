<?php

namespace App\Services;

use App\Models\Review;

class ReviewService
{

    private $review;

    public function __construct(Review $review)
    {
        $this->review = $review;
    }

    public function remove($id)
    {
        $this->review->newQuery()->findOrFail($id)->delete();
    }
}
