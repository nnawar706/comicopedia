<?php

namespace App\Http\Controllers;

use App\Http\Requests\BannerSettingRequest;
use App\Http\Requests\MultipleImageRequest;
use App\Services\BannerSettingService;
use Illuminate\Http\Request;

class BannerSettingController extends Controller
{
    private $service;

    public function __construct(BannerSettingService $service)
    {
        $this->service = $service;
    }

    public function getAll()
    {
        return view('admin.pages.banner');
    }

    public function read($id)
    {
        $data = $this->service->getOne($id);

        return response()->json($data);
    }

    public function store(BannerSettingRequest $request1, MultipleImageRequest $request2)
    {
        $type_id = $this->service->findOrCreateType($request1);

        $this->service->createSetting($request2, $type_id);

        return response()->json([
            'status' => true,
        ]);
    }
}
