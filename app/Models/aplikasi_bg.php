<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class aplikasi_bg extends Model
{
    use HasFactory;

    protected $table = 'aplikasi_bg';

    protected $fillable = [
        'aplikasi_id',
        'bg_id',
    ];
}
