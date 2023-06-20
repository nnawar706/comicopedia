<?php

namespace App\Http\Controllers;

use App\Http\Requests\ImageRequest;
use App\Http\Requests\ItemCreateRequest;
use App\Services\CategoryService;
use Illuminate\Http\Request;
use App\Services\ItemService;

class ItemController extends Controller
{
    private $service;
    private $categoryService;

    public function __construct(ItemService $service, CategoryService $categoryService)
    {
        $this->service = $service;
        $this->categoryService = $categoryService;
    }

    public function getAll()
    {
        return view('admin.pages.items');
    }

    public function createView()
    {
        $data = $this->categoryService->getCategories();

        return view('admin.pages.create-item')->with('data', $data);
    }

    public function create(ImageRequest $request1, ItemCreateRequest $request2)
    {
         $this->service->create($request1, $request2);

         return view('admin.pages.items')->with('message', 'New series has been stored successfully.');
    }
}
