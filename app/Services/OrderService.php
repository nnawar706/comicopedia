<?php

namespace App\Services;

use App\Models\Order;
use App\Models\OrderAddress;
use Doctrine\DBAL\Query\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

            Order::create([
                'user_id'                   => auth()->user()->id,
                'address_id'                => $address->id,
                'order_no'                  => 'ORD-'.date('smd').rand(100,999),
                'delivery_tracking_no'      => 'ORD-'.date('smd').rand(100,999),
                'contact'                   => $request['contact'],
            ]);

            DB::commit();
        } catch (QueryException $ex)
        {
            DB::rollback();

            return false;
        }
    }
}
