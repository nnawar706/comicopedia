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

    public function getOne($id)
    {
        return $this->type->newQuery()->with('banners')->findOrFail($id);
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
        foreach ($request->images as $image)
        {
            $banner = $this->banner->newQuery()->create([
                'banner_type_id' => $type_id,
            ]);

            saveFile($image, '/uploads/banners/',$banner,'photo_path');
        }
    }
}
