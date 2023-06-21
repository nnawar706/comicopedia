<?php

namespace App\Http\Controllers;

use App\Http\Requests\ImageRequest;
use App\Http\Requests\ItemCreateRequest;
use App\Http\Requests\ItemUpdateRequest;
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
        if($this->service->storeItem($request1, $request2))
        {
            $msg = 'New series has been stored successfully.';
        }
        else
        {
            $msg = 'Something went wrong. Please try again.';
        }

        return view('admin.pages.items')->with('message', $msg);
    }

    public function update(ItemUpdateRequest $request, $id)
    {
        $this->service->updateItem($request, $id);

        return view('admin.pages.items')->with('message', 'A series has been updated successfully.');
    }

    public function delete($id)
    {
        if($this->service->deleteItem($id))
        {
            return redirect()->back()->with('message', 'A series has been deleted successfully.');
        }
        else {
            return redirect()->back()->with('message', 'restrict');
        }
    }
}
