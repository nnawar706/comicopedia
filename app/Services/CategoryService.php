<?php

namespace App\Services;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryService
{
    private $category;

    public function __construct(Category $category)
    {
        $this->category = $category;
    }

    public function getCategories()
    {
        return $this->category->newQuery()->orderBy('order')->get();
    }

    public function createCategory(Request $request)
    {
        $cat = $this->category->newQuery()->create([
            'name' => $request->name,
        ]);

        $cat->order = $this->category->count();
        $cat->save();
    }
}
