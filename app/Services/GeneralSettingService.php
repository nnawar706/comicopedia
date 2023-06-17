<?php

namespace App\Services;

use App\Models\SiteInformation;
use Illuminate\Http\Request;

class GeneralSettingService
{
    private $info;

    public function __construct(SiteInformation $info)
    {
        $this->info = $info->find(1);
    }

    public function updateInfo(Request $request)
    {
        $this->info->update([
            'name' => $request->name,
            'email' => $request->email,
            'contact' => $request->contact,
            'about' => $request->about
        ]);

        if($request->file('logo'))
        {}
    }
}
