<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subsosmed extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'sosmed_id',
        'link',
    ];

    public function sosmed()
    {
        return $this->belongsTo(Sosmed::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
