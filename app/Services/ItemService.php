<?php

namespace App\Services;

use App\Models\Item;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ItemService
{
    private $item;
    private $categoryService;

    public function __construct(Item $item, CategoryService $categoryService)
    {
        $this->item = $item;
        $this->categoryService = $categoryService;
    }


    public function getItem($id)
    {
        return $this->item->newQuery()->with('volume_list','genre')->findOrFail($id);
    }

    public function storeItem(Request $request1, Request $request2)
    {
        DB::beginTransaction();
        try {
            $item = $this->item->newQuery()->create([
                'item_unique_id' => 'SER-' . date('Hsi') . '-' . rand(10000,99999),
                'genre_id'       => $request2->genre_id,
                'title'          => $request2->title,
                'detail'         => $request2->detail,
                'author'         => $request2->author,
                'magazine'       => $request2->magazine,
                'meta_keywords'  => $request2->meta_keywords,
            ]);

            saveFile($request1->file('image'), '/uploads/series/', $item, 'image_path');

            $this->categoryService->incrementItemCount($request2->genre_id);

            DB::commit();

            return true;
        }
        catch (QueryException $ex)
        {
            DB::rollback();

            return false;
        }

    }

    public function updateItem(Request $request, $id)
    {
        $item = $this->item->newQuery()->findOrFail($id);

        $item->update([
            'genre_id'      => $request->genre_id,
            'ISBN_no'       => $request->ISBN_no,
            'title'         => $request->title,
            'detail'        => $request->detail,
            'author'        => $request->author,
            'magazine'      => $request->magazine,
            'meta_keywords' => $request->meta_keywords,
        ]);

        if($request->hasFile('image'))
        {
            deleteFile($item->image_path);
            saveFile($request->file('image'), '/uploads/series/', $item, 'image_path');
        }
    }

    public function deleteItem($id)
    {
        try {
            $this->item->newQuery()->findOrFail($id)->delete();

            return true;
        }
        catch (QueryException $ex)
        {
            return false;
        }
    }
}
