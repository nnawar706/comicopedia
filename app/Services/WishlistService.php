<?php

namespace App\Services;

use App\Models\VolumeAttribute;
use App\Models\Wishlist;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class WishlistService
{
    private $wish;

    public function __construct(Wishlist $wish)
    {
        $this->wish = $wish;
    }

    public function addWish($volume_id)
    {
        $attribute_id = VolumeAttribute::where('volume_id',$volume_id)->where('name','Paperback')->first()->id;

        DB::beginTransaction();

        try {
            if(auth()->check())
            {
                $wish = $this->wish->newQuery()->where('user_id',auth()->user()->id)
                    ->where('volume_id',$volume_id)
                    ->where('attribute_id',$attribute_id)->first();
            }
            else
            {
                $wish = $this->wish->newQuery()->where('session_id',Session::get('customer_unique_id'))
                    ->where('volume_id',$volume_id)
                    ->where('attribute_id',$attribute_id)->first();
            }

            $request = array(
                'volume_id' => $volume_id,
                'attribute_id' => $attribute_id,
                'quantity' => 1
            );

            $this->createUpdateWish($request, $wish);

            DB::commit();

            return true;
        }
        catch (QueryException $ex)
        {
            DB::rollback();
            return false;
        }
    }

    private function createUpdateWish($request, $wish): void
    {
        if(is_null($wish))
        {
            $this->wish->newQuery()->create([
                'volume_id'    => $request['volume_id'],
                'attribute_id' => $request['attribute_id'],
                'quantity'     => $request['quantity'],
                'session_id'   => Session::get('customer_unique_id'),
                'user_id'      => auth()->check() ? auth()->user()->id : null,
            ]);

            updateSession('wish_quantity', 1);

        } else {
            $wish->quantity += $request['quantity'];
            $wish->save();
        }
    }

    public function getItemValue(): int
    {
        return $this->wish->newQuery()->where('user_id', auth()->user()->id)
            ->where('is_ordered','=',0)->count();
    }

    public function getWishList()
    {
        return $this->wish->newQuery()
            ->when(auth()->check()==true, function($query) {
                return $query->where('user_id', auth()->user()->id);
            })
            ->when(auth()->check()==false, function($query) {
                return $query->where('session_id', Session::get('customer_unique_id'));
            })
            ->leftJoin('volumes','wishlists.volume_id','=','volumes.id')
            ->leftJoin('items','volumes.item_id','=','items.id')
            ->leftJoin('volume_attributes','wishlists.attribute_id','=','volume_attributes.id')
            ->where('is_ordered','=',0)
            ->select('wishlists.*','volumes.price','volumes.discount','volume_attributes.id as attribute_id',
                'volume_attributes.name as attribute_name','volumes.title as volume','items.title as item',
                'volumes.image_path as volume_image','volumes.product_unique_id')
            ->orderBy('wishlists.id','desc')
            ->get();
    }
}
