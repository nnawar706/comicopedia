<?php

namespace App\Services;

use App\Models\Review;
use Illuminate\Http\Request;

class ReviewService
{

    private $review;

    public function __construct(Review $review)
    {
        $this->review = $review;
    }

    public function store(Request $request, $id)
    {
        $this->review->newQuery()->create([
            'volume_id' => $id,
            'user_id'   => auth()->user()->id ?? null,
            'comment'   => $request->comment,
            'rating'    => $request->rating
        ]);
    }

    public function remove($id)
    {
        $this->review->newQuery()->findOrFail($id)->delete();
    }
}
