<?php

namespace App\Services;

use App\Models\GeneralSetting;
use App\Models\SiteInformation;
use Illuminate\Http\Request;

class GeneralSettingService
{
    private $info;
    private $setting;

    public function __construct(SiteInformation $info, GeneralSetting $setting)
    {
        $this->info = $info->find(1);
        $this->setting = $setting->find(1);
    }

    public function getInfo()
    {
        return $this->info;
    }

    public function getConfig()
    {
        return $this->setting;
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

        if ($request->file('favicon'))
        {
            deleteFile($this->info->favicon_path);

            saveFile($request->file('favicon'), '/uploads/general/', $this->info, 'favicon_path');
        }
    }

    public function updateConfig(Request $request)
    {
        $this->setting->notify_admins_on_new_order = $request->input('notify_admins_on_new_order') ?? 0;
        $this->setting->email_admins_on_new_user_sign_in = $request->input('email_admins_on_new_user_sign_in') ?? 0;
        $this->setting->promo_on_new_user_sign_in = $request->input('promo_on_new_user_sign_in') ?? 0;
        $this->setting->welcome_mail_on_new_user_sign_in = $request->input('welcome_mail_on_new_user_sign_in') ?? 0;
        $this->setting->weekly_newsletter = $request->input('weekly_newsletter');

        $this->setting->save();
    }

}
