<?php

namespace App\Services;

use App\Models\UserCoupon;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CouponService
{
    private $coupon;

    public function __construct(UserCoupon $coupon)
    {
        $this->coupon = $coupon;
    }

    public function getCoupons()
    {
        return $this->coupon->newQuery()
            ->where('status',1)->whereDate('validity','<=',Carbon::today())
            ->when(auth()->check(), function($q) {
                return $q->where('user_id', auth()->user()->id)->orWhere('user_id',null);
            })
            ->when(!auth()->check(), function($q) {
                return $q->where('user_id', null);
            })
            ->get();
    }

    public function applyCoupon(Request $request)
    {
        $coupon = $this->coupon->newQuery()
            ->where('status',1)->whereDate('validity','<=',Carbon::today())
            ->where('user_id', auth()->user()->id)
            ->first();

        if(!is_null($coupon))
        {
            if($coupon->is_percentage == 1)
            {
                $amount = calculatePrice() * ($coupon->discount/100);
                putSession('promo_discount',$amount);
            }
            else{
                putSession('promo_discount',$coupon->discount);
            }
            putSession('promo',$request->code);
        }
    }
}
