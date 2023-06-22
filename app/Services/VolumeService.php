<?php

namespace App\Services;

use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VolumeService
{

    public function store(Request $request)
    {
        DB::beginTransaction();

        try {
            DB::commit();
        }
        catch(QueryException $ex)
        {
            DB::rollback();
        }
    }
}
