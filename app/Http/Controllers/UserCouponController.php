<?php

namespace App\Http\Controllers;

use App\Models\UserCoupon;
use App\Services\CouponService;
use Carbon\Carbon;
use Illuminate\Http\Request;

class UserCouponController extends Controller
{
    private $service;

    public function __construct(CouponService $service)
    {
        $this->service = $service;
    }

    public function availableCoupons()
    {
        $data = $this->service->getCoupons();

        return response()->json($data);
    }
}
