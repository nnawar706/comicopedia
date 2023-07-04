<?php

namespace App\Services;

use Illuminate\Http\Request;
use App\Models\Cart;

class CartService
{
    private $cart;

    public function __construct(Cart $cart)
    {
        $this->cart = $cart;
    }

    public function storeCart(Request $request)
    {
        
        return true;
    }
}
