<?php

namespace App\Http\Controllers;

use App\Http\Requests\ImageRequest;
use App\Http\Requests\ItemCreateRequest;
use Illuminate\Http\Request;
use App\Services\ItemService;

class ItemController extends Controller
{
    private $service;

    public function __construct(ItemService $service)
    {
        $this->service = $service;
    }

    public function getAll()
    {
        return view('admin.pages.items');
    }

    public function createView()
    {
        return view('admin.pages.create-item');
    }

    public function create(ImageRequest $request1, ItemCreateRequest $request2)
    {
        // $this->service->create($request1, $request2);
    }
}
