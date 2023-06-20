<?php

namespace App\Services;

use App\Models\Item;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Yajra\DataTables\Exceptions\Exception;
use Yajra\DataTables\Facades\DataTables;

class ItemService
{
    private $item;

    public function __construct(Item $item)
    {
        $this->item = $item;
    }

    /**
     * @throws Exception
     */
    public function getAll()
    {
//        return \datatables()
//            ->eloquent(Item::query())
//            ->addColumn('checkbox', function ($item) {
//                return '<input type="checkbox" name="item_id[]" value="'.$item->id.'">';
//            })
//            ->rawColumns(['checkbox'])
//            ->toJson();

        $data = Item::latest()->get();
        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function($row){
                $actionBtn = '<a href="javascript:void(0)" class="edit btn btn-success btn-sm">Edit</a> <a href="javascript:void(0)" class="delete btn btn-danger btn-sm">Delete</a>';
                return $actionBtn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

     public function storeItem(Request $request1, Request $request2)
     {
         $item = $this->item->newQuery()->create([
             'genre_id'      => $request2->genre_id,
             'ISBN_no'       => $request2->ISBN_no,
             'title'         => $request2->title,
             'detail'        => $request2->detail,
             'author'        => $request2->author,
             'magazine'      => $request2->magazine,
             'meta_keywords' => $request2->meta_keywords,
         ]);

         saveFile($request1->file('image'), '/uploads/series/', $item, 'image_path');
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
