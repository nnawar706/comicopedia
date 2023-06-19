<?php

namespace App\Services;

use App\Models\Item;

class ItemService
{
    private $item;

    public function __construct(Item $item)
    {
        $this->item = $item;
    }

    // public function create(Request $request1, Request $request2)
    // {

    // }
}
