<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BannerType extends Model
{
    use HasFactory;

    protected $table = 'banner_type';

    protected $fillable = [
        'name'
    ];

    protected $hidden = [
        'created_at'
    ];

    public function banners()
    {
        return $this->hasMany(BannerType::class, 'type_id');
    }
}
