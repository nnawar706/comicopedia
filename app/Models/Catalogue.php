<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Catalogue extends Model
{
    use HasFactory;

    protected $table = 'catalogues';

    protected $guarded = [
        'name'
    ];

    protected $hidden = [
        'created_at','updated_at'
    ];

    public function volumes()
    {
        return $this->hasMany(Volume::class, 'catalogue_id');
    }
}
