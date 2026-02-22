<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    protected $fillable = [
        'name',
        'description',
        'jenis',
        'fungsi_adat',
        'price',
        'stock',
        'image',
    ];
}
