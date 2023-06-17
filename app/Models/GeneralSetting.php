<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GeneralSetting extends Model
{
    use HasFactory;

    protected $table = 'general_settings';

    protected $fillable = [
        'notification_on_new_order',
        'mail_on_new_signin',
        'promo_on_signin'
    ];

    protected $hidden = [
        'created_at'
    ];
}
