<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $table = 'reviews';

    protected $fillable = [
        'volume_id',
        'user_id',
        'comment',
        'rating'
    ];

    protected $hidden = ['updated_at'];

    public function volume()
    {
        return $this->belongsTo(Volume::class, 'volume_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
