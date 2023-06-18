<?php

namespace App\Http\Controllers;

use App\Services\CategoryService;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    private $service;

    public function __construct(CategoryService $service)
    {
        $this->service = $service;
    }

    public function getAll()
    {
        $data = $this->service->getCategories();

        return view('admin.pages.categories')->with('data', $data);
    }

    public function create()
    {}
}
