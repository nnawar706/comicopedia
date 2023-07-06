<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    use HasFactory;

    protected $table = 'wishlists';

    protected $hidden = ['created_at','update_at'];

    protected $fillable = ['session_id','user_id','volume_id','attribute_id','quantity','is_ordered'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
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
