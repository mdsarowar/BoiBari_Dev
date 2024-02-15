<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unions extends Model
{
    use HasFactory;

    protected $fillable=[
        'upazilla_id',
        'name',
        'bn_name',
        'url'

    ];
}
