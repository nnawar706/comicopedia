<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $table = 'items';

    protected $fillable = [
        'item_unique_id','genre_id','title','detail','author','magazine','image_path','meta_keywords',
        'volumes','like_count','dislike_count'
    ];

    protected $hidden = [
        'updated_at'
    ];

    public function volume_list()
    {
        return $this->hasMany(Volume::class, 'item_id');
    }

    public function genre()
    {
        return $this->belongsTo(Category::class, 'genre_id');
    }

    public function ratings()
    {
        return $this->hasMany(ItemRating::class, 'item_id');
    }

}
