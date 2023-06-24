<?php

namespace App\Http\Controllers;

use App\Http\Requests\MultipleImageRequest;
use App\Services\BannerSettingService;

class BannerSettingController extends Controller
{
    private $service;

    public function __construct(BannerSettingService $service)
    {
        $this->service = $service;
    }

    public function getAll()
    {
        $data = $this->service->getAll();

        return view('admin.pages.banner')->with('data', $data);
//        return response()->json($data);
    }

    public function store(MultipleImageRequest $request, $id)
    {
        $this->service->createSetting($request, $id);

        return redirect()->back()->with('message', 'New banner has been uploaded successfully.');
    }

    public function delete($id)
    {
        $this->service->deleteBanner($id);

        return redirect()->back()->with('message', 'A banner has been deleted successfully.');
    }
}
