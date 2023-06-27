<?php

namespace App\Http\Controllers;

use App\Services\BannerSettingService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class EcommerceController extends Controller
{
    public function getMainPage()
    {
        $banners = Cache::remember('bannerList', 60*60*24, function() {
            return (new BannerSettingService)->getAll();
        });
        return view('welcome');
    }
}
