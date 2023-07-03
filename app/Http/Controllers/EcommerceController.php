<?php

namespace App\Http\Controllers;

use App\Http\Requests\SubscriberRequest;
use App\Models\Volume;
use App\Services\VolumeService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use App\Models\Catalogue;
use App\Models\Category;
use App\Models\Item;
use App\Models\Subscriber;
use App\Services\BannerSettingService;
use App\Services\CatalogueService;
use App\Services\CategoryService;
use App\Services\ItemService;
use App\Services\SubscriberService;

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
        $items = (new ItemService(new Item()))->getTopItems();

        $data = array(
            'banners'       => $banners,
            'catalogues'    => $catalogues,
            'genres'        => $genre,
            'items'         => $items
        );

        // return response()->json(['data' => $data]);
        return view('ecommerce.pages.welcome')->with('data', $data);
    }

    public function getItem($id)
    {
        $data = (new ItemService(new Item()))->getItem($id);

//         return response()->json(['data' => $data]);

        return view('ecommerce.pages.item-read')->with('data', $data);
    }

    public function getVolume($id)
    {
        $data = (new VolumeService(new Volume()))->getVolume($id);

        return response()->json(['data' => $data]);

//        return view('ecommerce.pages.volume-read')->with('data',$data);
    }

    public function subscribe(SubscriberRequest $request)
    {
        (new SubscriberService(new Subscriber()))->store($request);

        return redirect()->route('welcome')->with('message', 'You have been subscribed successfully.');
    }
}
