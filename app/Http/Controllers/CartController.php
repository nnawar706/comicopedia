<?php

namespace App\Http\Controllers;

use App\Http\Requests\CartRequest;
use App\Models\Cart;
use App\Services\CartService;

class CartController extends Controller
{
    public function addCart(CartRequest $request)
    {
        if((new CartService(new Cart()))->storeCart($request))
        {
            $msg = 'New volume has been added to cart.';
        } else {
            $msg = 'Something went wrong. Please try again.';
        }

        return redirect()->route('volume-info', ['id' => $request->volume_id])->with('message', $msg);
    }

    public function addToCart($volume_id)
    {
        if((new CartService(new Cart()))->storeToCart($volume_id))
        {
            $msg = 'New volume has been added to cart.';
        }
        else {
            $msg = 'Something went wrong. Please try again.';
        }

        return redirect()->back()->with('message', $msg);
    }

    public function cartView()
    {
        $data = (new CartService(new Cart()))->getCart();
        // return response()->json($data);
        return view('ecommerce.pages.cart')->with('data', $data);
    }

    public function deleteCart($id)
    {
        (new CartService(new Cart()))->deleteCart($id);

        return redirect()->back()->with('message', 'A cart item has been deleted successfully.');
    }

    public function deleteCartData()
    {
        (new CartService(new Cart()))->deleteCartAll();

        return redirect()->back()->with('message','Your cart has been refreshed.');
    }
}
