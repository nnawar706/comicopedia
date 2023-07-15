<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RestockRequest extends Model
{
    use HasFactory;

    protected $table = 'restock_requests';

    protected $fillable = ['user_id','volume_id','attribute_id'];

    protected $hidden = ['updated_at'];

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
