<?php

namespace App\Http\Controllers;

use App\Http\Requests\GeneralConfigUpdateRequest;
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
        $website_data = $this->service->getInfo();

        $website_configs = $this->service->getConfig();

        $data = array(
            'website' => $website_data,
            'config' => $website_configs
        );

        return view('admin.pages.setting')->with('data', $data);
    }

    public function updateInfo(SiteInformationUpdateRequest $request)
    {
        $this->service->updateInfo($request);

        return redirect()->back()->with('message', 'General information is updated successfully.');
    }

    public function updateConfig(GeneralConfigUpdateRequest $request)
    {
        $this->service->updateConfig($request);

        return redirect()->back()->with('message', 'Website configuration is updated successfully.');
    }

    public function download()
    {
    }
}
