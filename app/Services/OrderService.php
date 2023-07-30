<?php

namespace App\Services;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderAddress;
use App\Models\OrderItems;
use App\Models\OrderStatus;
use App\Models\Wishlist;
use Doctrine\DBAL\Query\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class OrderService
{

    public function getAll()
    {
        return Order::query()->leftJoin('users','orders.user_id','=','users.id')
            ->leftJoin('order_statuses','orders.status_id','=','order_statuses.id')->select('orders.*','users.id as user_id','users.name as user_name',
                'order_statuses.id as status_id','order_statuses.name as order_status')->latest();
    }

    public function getOrderData($id)
    {
        return Order::with('address','items.attribute','status')
            ->with(['items.volume' => function($q) {
                return $q->select('id','item_id','product_unique_id','title')->with(['item' => function($q1) {
                    return $q1->select('id','title');
                }]);
            }])
            ->with(['user'=>function($q) {
                return $q->select('id','name','email','profile_photo_path');
            }])->find($id);
    }

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
                'is_promo'                  => Session::get('promo') ?? null,
                'promo_discount'            => Session::get('promo_discount') ?? 0,
                'shipping_cost'             => calculateDistance($address->latitude, $address->longitude) * 50,
                'total'                     => Session::get('cart_price'),
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

    public function getRecentOrders()
    {
        return Order::with(['user' => function ($q) { return $q->select('id','name','email');}])->latest()->take(5)->get();
    }

    public function getCustomerOrders($user_id)
    {
        return Order::with('address','status')->withCount('items')->where('user_id', $user_id)->latest()->get();
    }

    public function getOrderSummary()
    {
        $end = Carbon::now();
        $start = $end->copy()->subMonths(11)->startOfMonth();

        $carts = Cart::selectRaw("DATE_FORMAT(created_at, '%M, %Y') as month_name, month(created_at) as month")
            ->selectRaw("COUNT(*) as total_carts")
            ->selectRaw("SUM(is_ordered = 1) as total_orders")
            ->selectRaw("SUM(is_ordered = 1) / COUNT(*) as cart_to_order_ratio")
            ->whereDate('created_at', '>=', now()->subMonths(12))
            ->groupBy(DB::raw("DATE_FORMAT(created_at, '%M, %Y')"), 'month')
            ->orderBy('created_at')
            ->get();

        $wishes = Wishlist::selectRaw("DATE_FORMAT(created_at, '%M, %Y') as month_name, month(created_at) as month")
        ->selectRaw("COUNT(*) as total_wish")
        ->selectRaw("SUM(is_ordered = 1) as total_cart")
        ->selectRaw("SUM(is_ordered = 1) / COUNT(*) as wish_to_cart_ratio")
        ->whereDate('created_at', '>=', now()->subMonths(12))
        ->groupBy(DB::raw("DATE_FORMAT(created_at, '%M, %Y')"), 'month')
        ->orderBy('created_at')
        ->get();

        $carts  = json_decode($carts, true);
        $wishes = json_decode($wishes, true);

        $curMonth = date('n');
//        done

        // for($i=0;$i<12;$i++) {
        //     $month = ($curMonth - $i + 12) % 12;
        //     $month = $month === 0 ? 12 : $month;
        //     $year = date('Y') - (date('n') < $month ? 1 : 0);

        //     $exist_cart = count(array_filter($carts, function ($obj) use ($month) {
        //         return $obj['month'] == $month;
        //     })) > 0;

        //     $exist_wish = count(array_filter($wishes, function ($obj) use ($month) {
        //         return $obj['month'] == $month;
        //     })) > 0;

        //     if (!$exist_cart) {
        //         $carts[] = array(
        //             'month_name'            => date('F', mktime(0, 0, 0, $month, 1)) . ', ' . $year,
        //             'month'                 => $month,
        //             'total_carts'           => 0,
        //             'total_orders'          => 0,
        //             'cart_to_order_ratio'   => 0
        //         );
        //     }
        //     if (!$exist_wish) {
        //         $wishes[] = array(
        //             'month_name'            => date('F', mktime(0, 0, 0, $month, 1)) . ', ' . $year,
        //             'month'                 => $month,
        //             'total_wish'            => 0,
        //             'total_cart'            => 0,
        //             'wish_to_cart_ratio'    => 0
        //         );
        //     }
        // }

        return array(
            'cart_data'     => $carts,
            'wish_data'     => $wishes,
        );
    }
}
