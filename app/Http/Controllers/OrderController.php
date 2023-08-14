<?php

namespace App\Http\Controllers;

use App\Http\Requests\PlaceOrderRequest;
use App\Models\Cart;
use App\Services\CartService;
use App\Services\OrderService;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    private $service;

    public function __construct(OrderService $service)
    {
        $this->service = $service;
    }

    public function getAll()
    {
        return view('admin/pages/orders');
    }

    public function getAuthUserOrders()
    {
        $data = $this->service->getCustomerOrders(auth()->user()->id);
        return view('ecommerce.pages.orders')->with('data',$data);
    }

    public function getAddresses()
    {
        return response()->json($this->service->getCoordinates());
    }

    public function getOrderStatuses()
    {
        return response()->json($this->service->getData());
    }

    public function store(PlaceOrderRequest $request)
    {
        $msg = (new CartService(new Cart()))->checkoutValidation();

        if($msg != 'done')
        {
            return redirect()->route('checkout')->with('message',$msg);
        } else {
            if($this->service->placeOrder($request))
            {
                return redirect()->route('checkout')->with('message','Your order has been placed successfully.');
            }
            return redirect()->route('checkout')->with('message','Something went wrong.');
        }
    }

    public function read($id)
    {
        $data = $this->service->getOrderData($id);

        return view('admin.pages.order-read')->with('data', $data);
    }

    public function getOrderSummary()
    {
        $data = $this->service->getOrderSummary();
        return response()->json($data);
    }

    public function getEarning()
    {
        $data = $this->service->getEarnings();
        return response()->json($data);
    }
}
