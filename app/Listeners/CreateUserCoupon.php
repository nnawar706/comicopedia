<?php

namespace App\Listeners;

use App\Models\GeneralSetting;
use App\Models\UserCoupon;
use Carbon\Carbon;
use Illuminate\Auth\Events\Registered;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Session;

class CreateUserCoupon
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param Registered $event
     * @return void
     */
    public function handle(Registered $event)
    {
        $user = $event->user;

        if(GeneralSetting::find(1)->promo_on_new_user_sign_in == 1)
        {

            UserCoupon::create([
                'user_id' => $user->id,
                'code'    => 'WELCOME10',
                'status'  => 1,
                'validity'=> Carbon::now('Asia/Dhaka')->addDays(30)->format('Y-m-d H:i:s'),
            ]);

            Session::put('coupon_code', 'WELCOME10');
        }
    }
}
