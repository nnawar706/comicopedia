<?php

namespace App\Services;

use App\Models\BannerSetting;
use App\Models\BannerType;
use Illuminate\Http\Request;

class BannerSettingService
{
    private $type;
    private $setting;

    public function __construct(BannerType $type, BannerSetting $setting)
    {
        $this->type = $type;
        $this->setting = $setting;
    }

    public function findOrCreateType(Request $request)
    {
        $type = $this->type->newQuery()->firstOrCreate(
            ['name' => $request->banner_type],
            ['name' => $request->banner_type]
        );

        return $type->id;
    }

    public function createSetting(Request $request, $type_id)
    {
        // $response = $this->uploadMultipleImage($request, 'uploads/banners/');

        // foreach($response as $item)
        // {
        //     $this->setting->create([
        //         'banner_type_id' => $type_id,
        //         'photo_path' => 'uploads/banners/' . $item
        //     ]);
        // }
    }
}
