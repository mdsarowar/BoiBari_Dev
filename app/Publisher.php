<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Publisher extends Model
{
    use HasFactory;
    public $translatable = ['title','description'];

    protected $fillable = [
        'title','description','status','image','featured','position'
    ];
}
