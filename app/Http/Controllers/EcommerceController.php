<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReviewRequest;
use App\Http\Requests\SubscriberRequest;
use App\Models\Review;
use App\Models\Volume;
use App\Services\ReviewService;
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
//        return view('ecommerce.pages.welcome')->with('data', $data);
        return view('welcome');
    }

    public function getItem($id)
    {
        $data = (new ItemService(new Item()))->getItem($id);

        return view('ecommerce.pages.item-read')->with('data', $data);
    }

    public function getVolume($id)
    {
        $volume = new VolumeService(new Volume());
        $data = $volume->getVolume($id);
        $volume->incrementView($id);

        return view('ecommerce.pages.volume-read')->with('data',$data);
    }

    public function rateVolume(ReviewRequest $request, $id)
    {
        (new VolumeService(new Volume()))->incrementReview($id);
        (new ReviewService(new Review()))->store($request, $id);

        return redirect()->route('rate-volume', ['id' => $id])->with('message', 'Your review has been stored successfully.');
    }

    public function subscribe(SubscriberRequest $request)
    {
        (new SubscriberService(new Subscriber()))->store($request);

        return redirect()->route('welcome')->with('message', 'You have been subscribed successfully.');
    }
}
