<?php

namespace App\Http\Controllers;

use App\Http\Requests\VolumeCreateRequest;
use App\Services\CatalogueService;
use App\Services\ItemService;
use App\Services\VolumeService;
use Illuminate\Http\Request;

class VolumeController extends Controller
{
    private $service1, $service2, $service3;

    public function __construct(VolumeService $service1, ItemService $service2, CatalogueService $service3)
    {
        $this->service1 = $service1;
        $this->service2 = $service2;
        $this->service3 = $service3;
    }

    public function getAll()
    {
        return view('admin.pages.volumes');
    }

    public function createView()
    {
        $data = array(
            'items' => $this->service2->getItems(),
            'catalogues' => $this->service3->getCatalogues(),
        );

        return view('admin.pages.create-volume')->with('data', $data);
//        return response()->json(['data' => $data]);
    }

    public function create(VolumeCreateRequest $request)
    {
        $this->service1->store($request);
    }
}
