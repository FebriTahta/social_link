<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aplikasi extends Model
{
    use HasFactory;

    public function getRouteKeyName()
    {
        return 'slug';
    }
    protected $fillable = [
        'user_id',
        'name',
        'slug',
        'img',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
