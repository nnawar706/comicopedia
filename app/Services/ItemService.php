<?php

namespace App\Services;

use App\Models\Category;
use App\Models\Item;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ItemService
{
    private $item;

    public function __construct(Item $item)
    {
        $this->item = $item;
    }

    public function getItems()
    {
        return $this->item->newQuery()->select('id','title')->latest()->get();
    }

    public function getTopItems()
    {
        return $this->item->newQuery()
        ->select('id','item_unique_id','title','image_path','volumes')
        ->orderBy('like_count', 'desc')->limit(15)->get();
    }

    public function getItemsByGenre($genre_id)
    {
        return $this->item->newQuery()->where('genre_id', $genre_id)
        ->orderBy('like_count','desc')->select('id','title')->take(15)->get();
    }

    public function getItem($id)
    {
        return $this->item->newQuery()->with('genre', 'volume_list')->findOrFail($id);
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

            (new CategoryService(new Category()))->incrementItemCount($request2->genre_id);

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

    public function incrementVolumes($id): void
    {
        $item = $this->item->newQuery()->find($id);
        $item->volumes += 1;
        $item->save();
    }
}
