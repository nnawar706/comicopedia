<?php

namespace App\Services;

use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use App\Models\Cart;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class CartService
{
    private $cart;

    public function __construct(Cart $cart)
    {
        $this->cart = $cart;
    }

    public function storeCart(Request $request)
    {
        DB::beginTransaction();

        try {
            if(auth()->check())
            {
                $cart = $this->cart->newQuery()->where('user_id',auth()->user()->id)
                    ->where('volume_id',$request->volume_id)
                    ->where('attribute_id',$request->attribute_id)->first();
            }
            else
            {
                $cart = $this->cart->newQuery()->where('session_id',Session::get('customer_unique_id'))
                    ->where('volume_id',$request->volume_id)
                    ->where('attribute_id',$request->attribute_id)->first();
            }
            $this->createUpdateCart($request, $cart);
            DB::commit();
            return true;
        }
        catch (QueryException $ex)
        {
            DB::rollback();
            return false;
        }
    }

    private function createUpdateCart($request, $cart = null): void
    {
        if(is_null($cart))
        {
            $this->cart->newQuery()->create([
                'volume_id'    => $request->volume_id,
                'attribute_id' => $request->attribute_id,
                'quantity'     => $request->quantity,
                'session_id'   => auth()->check() ? null : Session::get('customer_unique_id'),
                'user_id'      => auth()->check() ? auth()->user()->id : null,
            ]);
        } else {
            $cart->quantity += $request->quantity;
            $cart->save();
        }

    }
}
