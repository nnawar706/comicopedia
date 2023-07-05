<?php

namespace App\Listeners;

use App\Models\Cart;
use App\Services\CartService;
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
        $user = $event->user;

        $cart_ids = Cart::where('session_id', Session::get('customer_unique_id'))->select('id')->get();

        foreach($cart_ids as $id)
        {
            $session_cart = Cart::find($id['id']);

            if($user_cart = Cart::where('user_id', $user->id)
            ->where('volume_id',$session_cart->volume_id)
            ->where('attribute_id',$session_cart->attribute_id)->first())
            {
                $user_cart->quantity += $session_cart->quantity;

                $user_cart->save();

                $session_cart->delete();
            }
            else {
                $session_cart->update([
                    'user_id' => $user->id,
                ]);
            }
        }

        Session::put('cart_quantity', (new CartService(new Cart()))->getItemValue());

        Session::put('cart_price', (new CartService(new Cart()))->getAuthCartAmount());
    }
}
