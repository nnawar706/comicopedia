<?php

namespace App\Listeners;

use App\Models\Cart;
use App\Models\UserCoupon;
use App\Models\Wishlist;
use App\Services\CartService;
use App\Services\WishlistService;
use Carbon\Carbon;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Auth\Events\Login;
use Illuminate\Support\Facades\Session;

class UpdateSessionVariables
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

    public function handle(Login $event)
    {
        if(!auth()->guard('admin')->check())
        {
            $user = $event->user;

            Cart::where('session_id', Session::get('customer_unique_id'))->update([
                'user_id' => $user->id,
            ]);

            $wish_ids = Wishlist::where('session_id', Session::get('customer_unique_id'))->select('id')->get();

            foreach ($wish_ids as $id) {
                $session_wish = Wishlist::find($id['id']);

                if ($user_wish = Wishlist::where('user_id', $user->id)
                ->where('volume_id', $session_wish->volume_id)
                    ->where('attribute_id', $session_wish->attribute_id)->first()
                ) {
                    $user_wish->quantity += $session_wish->quantity;

                    $user_wish->save();

                    $session_wish->delete();
                } else {
                    $session_wish->update([
                        'user_id' => $user->id,
                    ]);
                }
            }

            $coupon = UserCoupon::where('user_id',$user->id)
                ->where('status',1)->whereDate('validity','<=',Carbon::today())->first();

            if($coupon)
            {
                Session::put('coupon_code', $coupon->code);
            }

            // Session::put('cart_quantity', (new CartService(new Cart()))->getItemValue());
            Session::put('wish_quantity', (new WishlistService(new Wishlist()))->getItemValue());
            // Session::put('cart_price', (new CartService(new Cart()))->getAuthCartAmount());
        }
    }
}
