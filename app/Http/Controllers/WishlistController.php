<?php

namespace App\Http\Controllers;

use App\Services\WishlistService;
use Illuminate\Http\Request;

class WishlistController extends Controller
{
    private $service;

    public function __construct(WishlistService $service)
    {
        $this->service = $service;
    }

    public function addToWish($volume_id)
    {
        if($this->service->addWish($volume_id))
        {
            $msg = 'A volume has been added to wishlist.';
        } else {
            $msg = 'Something went wrong. Please try again.';
        }

        return redirect()->back()->with('message',$msg);
    }
}
