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

    public function storeCart(Request $request): bool
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

            updateSession('cart_quantity', 1);

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
                'session_id'   => Session::get('customer_unique_id'),
                'user_id'      => auth()->check() ? auth()->user()->id : null,
            ]);
        } else {
            $cart->quantity += $request->quantity;
            $cart->save();
        }

    }

    public function getItemValue(): int
    {
        return $this->cart->newQuery()->where('user_id', auth()->user()->id)->where('is_ordered','=',0)->count();
    }

    public function getAuthCartAmount()
    {
        $data = $this->cart->newQuery()->leftJoin('volumes','carts.volume_id','=','volumes.id')
            ->leftJoin('volume_attributes','carts.attribute_id','=','volume_attributes.id')
            ->where('user_id', auth()->user()->id)
            ->where('is_ordered','=',0)
            ->select('carts.quantity','volumes.price','volumes.discount','volume_attributes.name')
            ->get();

        if(is_null($data))
        {
            return 0;
        }

        $amount = 0;

        foreach ($data as $value)
        {
            $amount = $value['discount'] ? ($amount + ($value['price'] - (($value['price']*$value['discount'])/100))*$value['quantity']) : ($amount + $value['price'] * $value['quantity']);
            if($value['name'] == 'Hardcover')
            {
                $amount += (150*$value['quantity']);
            }
        }
        return $amount;
    }
}
