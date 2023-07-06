<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Volume extends Model
{
    use HasFactory;

    protected $table = 'volumes';

    protected $fillable = [
        'item_id','catalogue_id','product_unique_id','title','isbn','details','release_date','quantity',
        'price','discount','image_path','status','view_count','review_count',
        'sell_count'
    ];

    protected $hidden = [
        'created_at','updated_at'
    ];

    public static function boot()
    {
        parent::boot();

        static::created(function($volume) {
            VolumeAttribute::create(['volume_id'=>$volume->id,'name'=>'Paperback','quantity'=>request()->input('quantity1')]);
            VolumeAttribute::create(['volume_id' => $volume->id, 'name' => 'Hardcover', 'quantity' => request()->input('quantity2')]);
        });
    }

    public function attributes()
    {
        return $this->hasMany(VolumeAttribute::class, 'volume_id');
    }

    public function item()
    {
        return $this->belongsTo(Item::class, 'item_id');
    }

    public function catalogue()
    {
        return $this->belongsTo(Catalogue::class, 'catalogue_id');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class, 'volume_id');
    }

    public function carts()
    {
        $this->hasMany(Cart::class, 'volume_id');
    }

    public function wishlists()
    {
        $this->hasMany(Wishlist::class, 'volume_id');
    }
}
