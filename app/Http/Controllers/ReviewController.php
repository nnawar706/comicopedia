<?php

namespace App\Http\Controllers;

use App\Services\ReviewService;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    private $service;

    public function __construct(ReviewService $service)
    {
        $this->service = $service;
    }

    public function delete($id)
    {
        $this->service->remove($id);

        return redirect()->back()->with('message', 'A customer review has been deleted successfully.');
    }
}
