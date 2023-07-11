<?php

namespace App\Services;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderAddress;
use App\Models\OrderItems;
use App\Models\OrderStatus;
use Doctrine\DBAL\Query\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class OrderService
{

    public function placeOrder(Request $request)
    {
        DB::beginTransaction();

        try {
            $address = OrderAddress::firstOrCreate([
                'address'  => $request['address'],
                'latitude' => $request['latitude'],
                'longitude'=> $request['longitude']
            ]);

            $order = Order::create([
                'user_id'                   => auth()->user()->id,
                'address_id'                => $address->id,
                'order_no'                  => 'ORD-'.date('smd').rand(100,999),
                'delivery_tracking_no'      => 'TRC-'.date('smd').rand(100,999),
                'contact'                   => $request['contact'],
                'is_promo'                  => Session::has('promo_discount') ? 1 : 0,
                'promo_discount'            => Session::get('promo_discount') ?? 0,
                'shipping_cost'             => calculateDistance($address->latitude, $address->longitude) * 50,
                'total'                     => Session::get('cart_price')-Session::get('promo_discount'),
                'user_comment'              => $request['comment'],
                'status_id'                 => 1
            ]);

            $cart = (new CartService(new Cart()))->getCart();

            if($cart)
            {
                foreach($cart as $item)
                {
                    OrderItems::create([
                        'order_id'      => $order->id,
                        'volume_id'     => $item->volume_id,
                        'attribute_id'  => $item->attribute_id,
                        'quantity'      => $item->quantity,
                        'price'         => $item->price,
                        'discount'      => $item->discount ? ($item->price*$item->discount)/100 : 0,
                        'total'         => $item->discount ? (($item->price - (($item->price*$item->discount)/100))*$item->quantity) : ($item->price*$item->quantity)
                    ]);
                }
            }
            DB::commit();

            Session::remove('promo');
            Session::remove('promo_discount');
            Session::remove('cart_price');
            Session::remove('cart_quantity');
            return true;
        } catch (QueryException $ex)
        {
            DB::rollback();

            return false;
        }
    }

    public function getCoordinates()
    {
        return OrderAddress::all();
    }

    public function getData()
    {
        return OrderStatus::withCount('orders')->get();
    }
}
