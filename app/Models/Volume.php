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
        'price','discount','cost','image_path','status','view_count','review_count',
        'sell_count'
    ];

    protected $hidden = [
        'created_at','updated_at'
    ];

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
}
