<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserCoupon extends Model
{
    use HasFactory;

    protected $table = 'user_coupons';

    protected $fillable = ['user_id','code', 'discount', 'status', 'validity'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
