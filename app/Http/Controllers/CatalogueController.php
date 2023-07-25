<?php

namespace App\Http\Controllers;

use App\Models\Catalogue;
use Illuminate\Http\Request;

class CatalogueController extends Controller
{
    public function catalogueData()
    {
        $data = Catalogue::withCount('volumes')->get();

        return response()->json($data);
    }
}
