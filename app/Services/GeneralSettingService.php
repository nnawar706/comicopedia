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
        $this->info->name = $request->name ?? $this->info->name;
        $this->info->email = $request->email ?? $this->info->email;
        $this->info->contact = $request->contact ?? $this->info->contact;
        $this->info->about = $request->about ?? $this->info->about;

        $this->info->facebook_url = $request->facebook_url ?? $this->info->facebook_url;
        $this->info->instagram_url = $request->instagram_url ?? $this->info->instagram_url;
        $this->info->youtube_url = $request->youtube_url ?? $this->info->youtube_url;
        $this->info->pinterest_url = $request->pinterest_url ?? $this->info->pinterest_url;

        $this->info->save();

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
