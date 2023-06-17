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
        return view('admin.pages.setting');
    }

    public function updateInfo(SiteInformationUpdateRequest $request)
    {
        $this->service->updateInfo($request);

        return redirect()->back()->with('message', 'General information is updated successfully.');
    }

}
