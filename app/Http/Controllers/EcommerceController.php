<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use App\Models\Catalogue;
use App\Models\Category;
use App\Services\BannerSettingService;
use App\Services\CatalogueService;
use App\Services\CategoryService;

class EcommerceController extends Controller
{
    public function getMainPage()
    {
        // $banners = Cache::remember('bannerList', 60*60*24, function() {
        //     return (new BannerSettingService)->getAll();
        // });
        // $catalogues = Cache::remember('cataloguesList', 60*60*24, function() {
        //     return (new CatalogueService(new Catalogue()))->getAllWithItems();
        // });

        $banners = (new BannerSettingService)->getAll();
        $catalogues = (new CatalogueService(new Catalogue()))->getAllWithItems();
        $genre = (new CategoryService(new Category()))->getCategories();

        $data = array(
            'banners' => $banners,
            'catalogues' => $catalogues,
            'genres' => $genre
        );

        // return response()->json(['data' => $data]);
        return view('welcome')->with('data', $data);
    }
}
