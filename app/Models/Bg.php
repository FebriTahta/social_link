<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bg extends Model
{
    use HasFactory;
    protected $fillable = [
        'bg',
        'bg_thumb'
    ];

    public function aplikasi()
    {
        return $this->belongsToMany(Aplikasi::class);
    }
}
