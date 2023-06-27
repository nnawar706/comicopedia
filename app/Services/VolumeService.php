<?php

namespace App\Services;

use App\Models\Volume;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VolumeService
{

    private $volume, $service;

    public function __construct(Volume $volume, ItemService $service)
    {
        $this->volume = $volume;
        $this->service = $service;
    }

    public function store(Request $request)
    {
        DB::beginTransaction();

        try {
            $volume = $this->volume->newQuery()->create([
                'item_id'               => $request->item_id,
                'catalogue_id'          => $request->catalogue_id,
                'product_unique_id'     => 'VOL-' . date('Hsi') . '-' . rand(10000,99999),
                'title'                 => $request->title,
                'isbn'                  => $request->isbn,
                'details'               => $request->details,
                'release_date'          => $request->release_date ?? date('Ymd'),
                'quantity'              => $request->quantity,
                'cost'                  => $request->cost,
                'price'                 => $request->price,
                'discount'              => $request->discount,
                'discount_active_till'  => $request->discount_active_till
            ]);

            saveFile($request->file('image'), '/uploads/volumes/', $volume, 'image_path');

            $this->service->incrementVolumes($request->item_id);

            DB::commit();

            return true;
        }
        catch(QueryException $ex)
        {
            DB::rollback();

            return false;
        }
    }
// 'item','catalogue','reviews'
    public function getVolume($id)
    {
        return $this->volume->newQuery()
        ->with(['item' => function($q) {
            $q->select('id','genre_id','title','magazine','meta_keywords')->with('genre');
        }])
        ->with('catalogue')
        ->with(['reviews.user' => function($q) {
            $q->select('id','name');
        }])
        ->findOrFail($id);
    }

    public function volumeList($item_id)
    {
        return $this->volume->newQuery()->select('title','quantity')->where('item_id',$item_id)->get();
    }

    public function updateStatus($id)
    {
        $volume = $this->volume->newQuery()->find($id);

        if($volume->status == 1)
        {
            $volume->status = 0;
        }
        else {
            $volume->status = 1;
        }

        $volume->save();
    }
}
