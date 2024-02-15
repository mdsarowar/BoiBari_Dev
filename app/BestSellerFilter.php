<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BestSellerFilter extends Model
{
    use HasFactory;

    protected $table = 'bestseller_filter';

    protected $fillable = ['filter_by'];
}
