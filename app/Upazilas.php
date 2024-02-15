<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Upazilas extends Model
{
    use HasFactory;

    protected $fillable=[
        'district_id',
        'name',
        'bn_name',
        'url'

    ];
}
