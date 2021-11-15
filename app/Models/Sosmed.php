<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sosmed extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'link',
        'status',
        'icon',
    ];

    public function subsosmed()
    {
        return $this->hasOne(Subsosmed::class);
    }
}
