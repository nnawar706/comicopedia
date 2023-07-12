<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryStoreRequest;
use App\Services\CategoryService;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    private $service;

    public function __construct(CategoryService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        $data = $this->service->getCategories();

        return response()->json($data);
    }

    public function getAll()
    {
        $data = $this->service->getCategories();

        return view('admin.pages.categories')->with('data', $data);
    }

    public function create(CategoryStoreRequest $request)
    {
        $this->service->createCategory($request);

        return redirect()->back()->with('message', 'New category is stored successfully.');
    }

    public function shuffle()
    {
        $message = $this->service->reorderCategories(array_keys(request()->except('_method','_token')));

        return redirect()->back()->with('message', $message);
    }
}
