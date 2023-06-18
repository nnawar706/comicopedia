<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiteInformation extends Model
{
    use HasFactory;

    protected $table = 'site_information';

    protected $fillable = [
        'name',
        'email',
        'contact',
        'logo_path',
        'favicon_path',
        'about',
        'facebook_url',
        'instagram_url',
        'youtube_url',
        'pinterest_url',
    ];

    protected $hidden = [
        'created_at'
    ];
}
