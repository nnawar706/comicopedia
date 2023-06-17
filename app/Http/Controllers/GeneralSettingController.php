<?php

namespace App\Http\Controllers;

use App\Http\Requests\SiteInformationUpdateRequest;
use App\Services\GeneralSettingService;

class GeneralSettingController extends Controller
{
    private $service;

    public function __construct(GeneralSettingService $service)
    {
        $this->service = $service;
    }

    public function show()
    {
        $data = $this->service->getInfo();

        return view('admin.pages.setting')->with('data', $data);
    }

    public function updateInfo(SiteInformationUpdateRequest $request)
    {
        $this->service->updateInfo($request);

        return redirect()->back()->with('message', 'General information is updated successfully.');
    }

}
