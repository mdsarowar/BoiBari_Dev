<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Districts extends Model
{
    use HasFactory;
    protected $fillable=[

        'division_id',
        'name',
        'bn_name',
        'lat',
        'lon',
        'url'

    ];
}
