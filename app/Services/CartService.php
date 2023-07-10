<?php

namespace App\Services;

use App\Models\VolumeAttribute;
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
            $cart = $this->cart->newQuery()->where('session_id', Session::get('customer_unique_id'))
            ->where('volume_id', $request->volume_id)
                ->where('attribute_id', $request->attribute_id)->first();

            $this->createUpdateCart($request, $cart);

            DB::commit();

            putSession('cart_price', calculatePrice());

            return true;
        }
        catch (QueryException $ex)
        {
            DB::rollback();
            return false;
        }
    }

    public function storeToCart($volume_id): bool
    {
        $attribute_id = VolumeAttribute::where('volume_id',$volume_id)->where('name','Paperback')->first()->id;

        DB::beginTransaction();

        try {
            $cart = $this->cart->newQuery()->where('session_id', Session::get('customer_unique_id'))
            ->where('volume_id', $volume_id)
            ->where('attribute_id', $attribute_id)->first();

            $request = array(
                'volume_id' => $volume_id,
                'attribute_id' => $attribute_id,
                'quantity' => 1
            );

            $this->createUpdateCart($request, $cart);

            DB::commit();

            putSession('cart_price', calculatePrice());

            return true;
        }
        catch (QueryException $ex)
        {
            DB::rollback();
            return false;
        }
    }

    private function createUpdateCart($request, $cart = null)
    {
        if(is_null($cart))
        {
            $this->cart->newQuery()->create([
                'volume_id'    => $request['volume_id'],
                'attribute_id' => $request['attribute_id'],
                'quantity'     => $request['quantity'],
                'session_id'   => Session::get('customer_unique_id'),
                'user_id'      => auth()->check() ? auth()->user()->id : null,
            ]);

            updateSession('cart_quantity', 1);

        } else {
            $cart->quantity += $request['quantity'];
            $cart->save();
        }
    }



    // public function getItemValue(): int
    // {
    //     return $this->cart->newQuery()->where('user_id', auth()->user()->id)->where('is_ordered','=',0)->count();
    // }

    // public function getAuthCartAmount()
    // {
    //     $data = $this->cart->newQuery()->leftJoin('volumes','carts.volume_id','=','volumes.id')
    //         ->leftJoin('volume_attributes','carts.attribute_id','=','volume_attributes.id')
    //         ->where('user_id', auth()->user()->id)
    //         ->where('is_ordered','=',0)
    //         ->select('carts.quantity','volumes.price','volumes.discount','volume_attributes.name')
    //         ->get();

    //     if(is_null($data))
    //     {
    //         return 0;
    //     }

    //     $amount = 0;

    //     foreach ($data as $value)
    //     {
    //         $amount = $value['discount'] ? ($amount + ($value['price'] - (($value['price']*$value['discount'])/100))*$value['quantity']) : ($amount + $value['price'] * $value['quantity']);
    //         if($value['name'] == 'Hardcover')
    //         {
    //             $amount += (150*$value['quantity']);
    //         }
    //     }
    //     return $amount;
    // }

    public function getCart()
    {
        return $this->cart->newQuery()
            ->where('session_id', Session::get('customer_unique_id'))
            ->leftJoin('volumes','carts.volume_id','=','volumes.id')
            ->leftJoin('items','volumes.item_id','=','items.id')
            ->leftJoin('volume_attributes','carts.attribute_id','=','volume_attributes.id')
            ->where('is_ordered','=',0)
            ->select('carts.*','volumes.price','volumes.discount','volume_attributes.id as attribute_id',
                'volume_attributes.name as attribute_name','volumes.title as volume','items.title as item',
                'volumes.image_path as volume_image','volumes.product_unique_id')
            ->orderBy('carts.id','desc')
            ->get();
    }

    public function deleteCart($id)
    {
        $cart = $this->cart->newQuery()->findOrFail($id);

        updateSession('cart_quantity', -1);

        updateSession('cart_price', -(calculatePrice($cart)));

        $cart->delete();
    }

    public function deleteCartAll()
    {
        if(auth()->check())
        {
            $this->cart->newQuery()->where('user_id', auth()->user()->id)->where('is_ordered',0)->delete();
        }
        else {
            $this->cart->newQuery()->where('session_id', Session::get('customer_unique_id'))->delete();
        }

        Session::put('cart_quantity',0);
        Session::put('cart_price', 0);
    }

    public function checkoutValidation(): string
    {
        return 'done';
    }
}
