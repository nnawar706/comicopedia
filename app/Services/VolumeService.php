<?php

namespace App\Services;

use App\Models\Item;
use App\Models\Volume;
use App\Models\Category;
use App\Models\Catalogue;
use Illuminate\Support\Carbon;
use App\Models\VolumeAttribute;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VolumeService
{

    private $volume;

    public function __construct(Volume $volume)
    {
        $this->volume = $volume;
    }

    public function store(Request $request)
    {
        DB::beginTransaction();

        try {
            $volume = $this->volume->newQuery()->create([
                'item_id'               => $request->item_id,
                'catalogue_id'          => $request->catalogue_id,
                'product_unique_id'     => 'VOL-' . date('Hsi') . '-' . rand(10000,99999),
                'title'                 => $request->title,
                'isbn'                  => $request->isbn,
                'details'               => $request->details,
                'release_date'          => $request->release_date ?? date('Ymd'),
                'quantity'              => $request->quantity1 + $request->quantity2,
                'price'                 => $request->price,
                'discount'              => $request->discount,
                'discount_active_till'  => Carbon::parse($request->discount_active_till)->format('Y-m-d')
            ]);

            saveFile($request->file('image'), '/uploads/volumes/', $volume, 'image_path');

            DB::commit();

            return true;
        }
        catch(QueryException $ex)
        {
            DB::rollback();

            return false;
        }
    }

    public function getMostViewed()
    {
        return array(
            'data' => $this->volume->newQuery()->with(['item' => function ($q) {
                            $q->select('id', 'title');
                        }])->select('id', 'item_id', 'title', 'view_count')
                        ->orderBy('view_count', 'desc')->limit(5)->get(),
            'total'=> $this->volume->newQuery()->sum('view_count')
        );
    }

    public function getVolume($id)
    {
        return $this->volume->newQuery()
        ->with(['item' => function($q) {
            $q->select('id','genre_id','author','title','magazine','meta_keywords')->with('genre');
        }])
        ->with('catalogue','attributes')
        ->with(['reviews.user' => function($q) {
            $q->select('id','name');
        }])
        ->findOrFail($id);
    }

    public function getAllData(Request $request, $id)
    {
        return array(
            'genre'      => (new CategoryService(new Category()))->get($id),

            'items'      => (new ItemService(new Item))->getItemsByGenre($id),

            'latest'     => $this->volume->newQuery()->whereHas('item', function($q) use($id) {
                                $q->where('genre_id', $id);
                            })
                            ->with(['item' => function($q) {
                                $q->select('id','title');
                            }])->where('catalogue_id', 1)->where('status',1)
                            ->select('id','item_id','title','price','image_path')->orderBy('sell_count','desc')->get(),

            'offers'     => $this->volume->newQuery()->whereHas('item', function ($q) use ($id) {
                                $q->where('genre_id', $id);
                            })
                            ->with(['item' => function ($q) {
                                $q->select('id', 'title');
                            }])->where('catalogue_id','=',5)->where('status','=',1)
                            ->select('id', 'item_id', 'title', 'price', 'discount', 'discount_active_till', 'image_path')->orderBy('sell_count', 'desc')->get(),

            'catalogue'  => $this->volume->newQuery()->whereHas('item', function ($q) use ($id) {
                                $q->where('genre_id', $id);
                            })
                            ->when(!is_null($request->catalogue), function($q) use($request) {
                                return $q->where('catalogue_id', $request->input('catalogue'));
                            })->whereNot('catalogue_id',5)
                            ->when(!is_null($request->min_price) && !is_null($request->max_price), function ($q) use($request) {
                                return $q->whereBetween('price', [$request->min_price, $request->max_price]);
                            })
                            ->where('status','=',1)->with(['item' => function($q) {
                                $q->select('id','title');
                            }])->select('id','item_id','title','price','image_path')
                            ->latest()->paginate(3)->appends($request->except('page','per_page')),
        );
    }

    public function getShopData(Request $request)
    {
        return array(
            'genre'      => (new CategoryService(new Category()))->getCategories(),

            'items'      => (new ItemService(new Item))->getTopItems(),
//
//            'latest'     => $this->volume->newQuery()->whereHas('item', function($q) use($id) {
//                $q->where('genre_id', $id);
//            })
//                ->with(['item' => function($q) {
//                    $q->select('id','title');
//                }])->where('catalogue_id', 1)->where('status',1)
//                ->select('id','item_id','title','price','image_path')->orderBy('sell_count','desc')->get(),
//
            'offers'     => $this->volume->newQuery()
                ->when(!is_null(request()->input('genre_id')), function ($query) use($request) {
                    return $query->whereHas('item', function ($q) use ($request) {
                        $q->where('genre_id', $request->genre_id);
                    });
                })
                ->with(['item' => function ($q) {
                    $q->select('id', 'title');
                }])->where('catalogue_id','=',5)
                ->select('id', 'item_id', 'title', 'price', 'discount', 'discount_active_till', 'image_path', 'status')->orderBy('sell_count', 'desc')->get(),

            'catalogue'  => $this->volume->newQuery()
                ->when(!is_null($request->catalogue), function($q) use($request) {
                    return $q->where('catalogue_id', $request->input('catalogue'));
                })->whereNot('catalogue_id',5)
                ->when(!is_null($request->min_price) && !is_null($request->max_price), function ($q) use($request) {
                    return $q->whereBetween('price', [$request->min_price, $request->max_price]);
                })
                ->with(['item' => function($q) {
                    $q->select('id','title');
                }])->select('id','item_id','title','price','image_path', 'status')
                ->latest()->paginate(6)->appends($request->except('page','per_page')),
        );
    }

    public function volumeList($item_id)
    {
        return $this->volume->newQuery()->select('title','quantity')->where('item_id',$item_id)->get();
    }

    public function updateStatus($id)
    {
        $volume = $this->volume->newQuery()->find($id);

        if($volume->status == 1)
        {
            $volume->status = 0;
        }
        else {
            $volume->status = 1;
        }

        $volume->save();
    }

    public function incrementView($id)
    {
        $volume = $this->volume->newQuery()->find($id);
        $volume->view_count += 1;
        $volume->save();
    }

    public function decrementView($id)
    {
        $volume = $this->volume->newQuery()->find($id);
        $volume->view_count += 1;
        $volume->save();
    }

    public function incrementSell($id)
    {
        $volume = $this->volume->newQuery()->find($id);
        $volume->sell_count += 1;
        $volume->save();
    }

    public function incrementReview($id)
    {
        $volume = $this->volume->newQuery()->find($id);
        $volume->review_count += 1;
        $volume->save();
    }

    public function getRelatedVolumes($id)
    {
        $genre = $this->volume->newQuery()->find($id)->item->genre->id;

        return $this->volume->newQuery()
            ->leftJoin('items','volumes.item_id','=','items.id')
            ->select('volumes.id as volume_id','volumes.title as volume','volumes.price',
            'volumes.discount','volumes.discount_active_till','volumes.image_path','items.title as item')
            ->where('items.genre_id',$genre)
            ->where('volumes.status',1)
            ->where('volumes.catalogue_id','!=',2)
            ->orderBy('volumes.sell_count','desc')
            ->limit(8)->get();
    }

    public function getSearchResults()
    {
        return $this->volume->newQuery()->leftJoin('items','volumes.item_id','=','items.id')
            ->where('items.title', 'like', '%'.request()->name.'%')
            ->orWhere('volumes.title', 'like', '%'.request()->name.'%')
            ->select('items.title as item','volumes.title as volume','volumes.id as volume_id')
            ->orWhere('items.author', 'like', '%'.request()->name.'%')
            ->orWhere('items.magazine', 'like', '%'.request()->name.'%')
            ->take(request()->input('limit'))->get();
    }

    public function stockRequest(Request $request)
    {
    }
}
