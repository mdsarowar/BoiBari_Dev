<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BillingAddress extends Model
{
    protected $fillable = [
        'firstname','address','email','mobile','pincode','country_id','division_id','district_id','upazila_id','union_id','state','city','user_id','type'
    ];

    public function getdivisions(){
        return $this->belongsTo(Division::class,'division_id')->withDefault();
//        return $this->belongsTo(Division::class, 'division_id','id');
    }


    public function getdistrict(){
        return $this->belongsTo(Districts::class,'district_id')->withDefault();
    }
    public function getupazila(){
        return $this->belongsTo(Upazilas::class,'upazila_id')->withDefault();
    }
    public function getunion(){
        return $this->belongsTo(Unions::class,'union_id')->withDefault();
    }
    public function cities(){
        return $this->belongsTo(Allcity::class,'city');
    }

    public function countiess(){
        return $this->belongsTo(Allcountry::class,'country_id');
    }

    public function states(){
        return $this->belongsTo(Allstate::class,'state');
    }
}
