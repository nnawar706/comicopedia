<?php

namespace App\Http\Controllers;

use App\Http\Requests\ApplyCouponRequest;
use App\Http\Requests\ReviewRequest;
use App\Http\Requests\SubscriberRequest;
use App\Models\Review;
use App\Models\UserCoupon;
use App\Models\Volume;
use App\Models\Wishlist;
use App\Services\CouponService;
use App\Services\ReviewService;
use App\Services\VolumeService;
use App\Services\WishlistService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use App\Models\Catalogue;
use App\Models\Category;
use App\Models\Item;
use App\Models\Cart;
use App\Models\Subscriber;
use App\Services\BannerSettingService;
use App\Services\CartService;
use App\Services\CatalogueService;
use App\Services\CategoryService;
use App\Services\ItemService;
use App\Services\SubscriberService;
use Illuminate\Support\Facades\Session;

class EcommerceController extends Controller
{
    public function getMainPage()
    {
        if(!Session::has('customer_unique_id'))
        {
            Session::put('customer_unique_id', uniqid('CUS-'));
        }
        if(!Session::has('cart_quantity'))
        {
            Session::put('cart_quantity', 0);
        }
        if(!Session::has('wish_quantity'))
        {
            auth()->check() ? Session::put('wish_quantity', (new WishlistService(new Wishlist()))->getItemValue()) : Session::put('wish_quantity', 0);
        }
        if(!Session::has('cart_price'))
        {
            Session::put('cart_price', 0);
        }
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
            'items'         => $items
        );

//         return response()->json(['data' => $data]);
        return view('ecommerce.pages.welcome')->with('data', $data);
    }

    public function checkoutView()
    {
        if(auth()->check())
        {
            $data = (new CartService(new Cart()))->getCart();
            return view('ecommerce.pages.checkout')->with('data',$data);
        } else {
            return redirect()->back()->with('message', 'You need to login first.');
        }
    }

    public function getGenre(Request $request, $id)
    {
        $data = (new VolumeService(new Volume()))->getAllData($request, $id);

        return view('ecommerce.pages.category')->with('data', $data);

//         return response()->json(['data' => $data]);
    }

    public function getItem($id)
    {
        $data = (new ItemService(new Item()))->getItem($id);

        return view('ecommerce.pages.item-read')->with('data', $data);
    }

    public function getVolume($id)
    {
        $volume = new VolumeService(new Volume());

        // $info = Cache::remember('volumeInfo', 60*60*24, function () use ($volume, $id) {
        //     return $volume->getVolume($id);
        // });

        // $related_volumes = Cache::remember('relatedVolumes', 60 * 60 * 24, function () use ($volume, $id) {
        //     return $volume->getRelatedVolumes($id);
        // });

        // $data = array(
        //     'info'    => $info,
        //     'related' => $related_volumes
        // );

        $data = array(
            'info'    => $volume->getVolume($id),
            'related' => $volume->getRelatedVolumes($id)
        );

        $volume->incrementView($id);

        return view('ecommerce.pages.volume-read')->with('data',$data);

        // return response()->json($data);
    }

    public function rateVolume(ReviewRequest $request, $id)
    {
        (new VolumeService(new Volume()))->incrementReview($id);
        (new ReviewService(new Review()))->store($request, $id);

        return redirect()->route('volume-info', ['id' => $id])->with('message', 'Your review has been stored successfully.');
    }

    public function subscribe(SubscriberRequest $request)
    {
        (new SubscriberService(new Subscriber()))->store($request);

        return redirect()->route('welcome')->with('message', 'You have been subscribed successfully.');
    }

    public function addCoupon(ApplyCouponRequest $request)
    {
        (new CouponService(new UserCoupon()))->applyCoupon($request);

        return redirect()->back()->with('message', 'You have added a promo code successfully.');
    }

    public function searchOptions()
    {
        if(\request()->input('apiKey') == 'c704212b54af40b3af542df235f28ac3')
        {
            return response()->json((new VolumeService(new Volume()))->getSearchResults());
        } else {
            return response()->json(['error' => 'error']);
        }
    }
}
