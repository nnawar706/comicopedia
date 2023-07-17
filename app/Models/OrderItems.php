<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;

class OrderItems extends Model
{
    use HasFactory;

    protected $table = 'order_items';

    protected $fillable = ['order_id','volume_id','attribute_id','quantity','price','discount','total'];

    protected $hidden = ['created_at','updated_at'];

    public static function boot()
    {
        parent::boot();

        static::created(function($item) {
            Cart::where('session_id',Session::get('customer_unique_id'))
            ->where('user_id',auth()->user()->id)
            ->where('volume_id',$item->volume_id)
            ->where('attribute_id',$item->attribute_id)
            ->where('quantity',$item->quantity)
            ->where('is_ordered',0)
            ->update([
                'is_ordered' => 1
            ]);

            $attribute = VolumeAttribute::find($item->attribute_id);
            $attribute->quantity -= $item->quantity;
            $volume = Volume::find($item->volume_id);
            $volume->quantity -= $item->quantity;

            $attribute->save();
            $volume->save();
        });
    }

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }

    public function volume()
    {
        return $this->belongsTo(Volume::class, 'volume_id');
    }

    public function attribute()
    {
        return $this->belongsTo(VolumeAttribute::class, 'attribute_id');
    }
}
