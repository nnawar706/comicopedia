<?php

namespace App\Services;

use App\Models\BannerSetting;
use App\Models\BannerType;
use Illuminate\Http\Request;

class BannerSettingService
{
    private $type;
    private $banner;

    public function __construct(BannerType $type, BannerSetting $banner)
    {
        $this->type     = $type;
        $this->banner   = $banner;
    }

    public function getAll()
    {
        return $this->type->newQuery()->with('banners')->orderBy('id')->get();
    }

    public function createSetting(Request $request, $type_id): void
    {
        foreach ($request->images as $image)
        {
            $banner = $this->banner->newQuery()->create([
                'banner_type_id' => $type_id,
            ]);

            saveFile($image, 'uploads/banners/',$banner,'photo_path');
        }
    }

    public function deleteBanner($id): void
    {
        $banner = $this->banner->newQuery()->find($id);

        deleteFile($banner->photo_path);

        $banner->delete();
    }
}
