<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GeneralSetting extends Model
{
    use HasFactory;

    protected $table = 'general_settings';

    protected $fillable = [
        'notify_admins_on_new_order',
        'email_admins_on_new_user_sign_in',
        'promo_on_new_user_sign_in',
        'welcome_mail_on_new_user_sign_in'
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];
}
