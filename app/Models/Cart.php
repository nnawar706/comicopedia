<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $table = 'carts';

    protected $hidden = ['created_at', 'updated_at'];

    protected $fillable = ['session_id','user_id','volume_id','quantity','is_ordered'];

    public function customer()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function volume()
    {
        return $this->belongsTo(Volume::class, 'volume_id');
    }
}
