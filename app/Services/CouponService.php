<?php

namespace App\Services;

use App\Models\UserCoupon;
use Carbon\Carbon;

class CouponService
{

    public function getCoupons()
    {
        return UserCoupon::where('user_id', auth()->user()->id)
            ->orWhere('user_id',null)->where('status',1)->whereDate('validity','<=',Carbon::today())->get();
    }
}
