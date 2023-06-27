<?php

namespace App\Services;

use App\Models\BannerSetting;
use App\Models\BannerType;
use Illuminate\Http\Request;

class BannerSettingService
{
    public function getAll()
    {
        return BannerType::with('banners')->orderBy('id')->get();
    }

    public function createSetting(Request $request, $type_id): void
    {
        foreach ($request->images as $image)
        {
            $banner = BannerSetting::create([
                'banner_type_id' => $type_id,
            ]);

            saveFile($image, 'uploads/banners/',$banner,'photo_path');
        }
    }

    public function deleteBanner($id): void
    {
        $banner = BannerSetting::find($id);

        deleteFile($banner->photo_path);

        $banner->delete();
    }
}
