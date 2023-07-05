<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VolumeAttribute extends Model
{
    use HasFactory;

    protected $table = 'volume_attributes';

    protected $hidden = ['created_at', 'updated_at'];

    protected $fillable = ['volume_id','name','quantity'];

    public function volume()
    {
        return $this->belongsTo(Volume::class, 'volume_id');
    }

    public function carts()
    {
        return $this->hasMany(Cart::class, 'attribute_id');
    }
}
