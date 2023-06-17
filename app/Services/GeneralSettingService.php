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

    public function getInfo()
    {
        return $this->info;
    }

    public function updateInfo(Request $request)
    {
        // $this->info->update([
        //     'name' => $request->name,
        //     'email' => $request->email,
        //     'contact' => $request->contact,
        //     'about' => $request->about
        // ]);

        if($request->file('logo'))
        {
            deleteFile($this->info->logo_path);

            saveFile($request->file('logo'), 'uploads/general/', $this->info, 'logo_path');
        }

        if ($request->file('favicon')) {
            saveFile($request->file('favicon'), '/uploads/general/', $this->info, 'favicon_path');
        }
    }
}
