<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UmkmProfile extends Model
{
    protected $table = 'umkm_profiles';

    protected $fillable = [
        'name',
        'address',
        'phone',
        'latitude',
        'longitude',
    ];

    protected $casts = [
        'latitude' => 'float',
        'longitude' => 'float',
    ];
}
