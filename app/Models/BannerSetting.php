<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BannerSetting extends Model
{
    use HasFactory;

    protected $table = 'banner_settings';

    protected $fillable = [
        'type_id',
        'photo_path'
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    public function type()
    {
        return $this->belongsTo(BannerType::class, 'type_id');
    }
}
