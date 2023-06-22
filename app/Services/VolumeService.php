<?php

namespace App\Services;

use App\Models\Volume;
use Carbon\Carbon;
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

    public function store(Request $request): bool
    {
        DB::beginTransaction();

        try {
            $volume = $this->volume->newQuery()->create([
                'item_id'               => $request->item_id,
                'catalogue_id'          => $request->catalogue_id,
                'product_unique_id'     => 'VOL-' . date('Hsi') . '-' . rand(10000,99999),
                'title'                 => $request->title,
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
}
