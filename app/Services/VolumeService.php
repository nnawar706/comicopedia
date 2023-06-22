<?php

namespace App\Services;

use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VolumeService
{

    public function store(Request $request): bool
    {
        DB::beginTransaction();

        try {
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
