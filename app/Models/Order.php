<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';

    protected $fillable = [
        'user_id','address_id','order_no','delivery_tracking_no','contact','is_promo',
        'promo_discount','shipping_cost','total','status_id'
    ];

    protected $hidden = ['updated_at'];

    public static function boot()
    {
        parent::boot();

        static::created(function($order) {
            UserCoupon::where('user_id',auth()->user()->id)
                ->where('code',Session::get('promo'))
                ->where('status',1)
                ->update(['status' => 0]);

            if(GeneralSetting::find(1)->notify_admins_on_new_order == 1)
            {
                notifyAdmins(1, 'A new order has been placed', 'order', $order->id, 'warning');
            }
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function address()
    {
        return $this->belongsTo(OrderAddress::class, 'address_id');
    }

    public function status()
    {
        return $this->belongsTo(OrderStatus::class, 'status_id');
    }
}
