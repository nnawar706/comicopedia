<?php

namespace App\Http\Controllers;

use App\Http\Requests\SiteInformationUpdateRequest;
use App\Models\GeneralSetting;
use Illuminate\Http\Request;

class GeneralSettingController extends Controller
{
    public function show()
    {
        return view('admin.pages.setting');
    }

    public function edit()
    {
        //
    }

    public function updateInfo(SiteInformationUpdateRequest $request)
    {}

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\GeneralSetting  $generalSetting
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, GeneralSetting $generalSetting)
    {
        //
    }
}
