<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Author extends Model
{
    use HasTranslations;

    public $translatable = ['title','description'];

    protected $fillable = [
        'title','description','status','image','featured','position'
    ];
}
