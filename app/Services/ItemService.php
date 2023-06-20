<?php

namespace App\Services;

use App\Models\Item;
use Illuminate\Http\Request;

class ItemService
{
    private $item;

    public function __construct(Item $item)
    {
        $this->item = $item;
    }

     public function create(Request $request1, Request $request2)
     {
         $item = $this->item->newQuery()->create([
             'genre_id' => $request2->genre_id,
             'ISBN_no' => $request2->ISBN_no,
             'title' => $request2->title,
             'detail' => $request2->detail,
             'author' => $request2->author,
             'magazine' => $request2->magazine,
             'meta_keywords' => $request2->meta_keywords,
         ]);

         saveFile($request1->file('image'), '/uploads/series/', $item, 'image_path');
     }
}
