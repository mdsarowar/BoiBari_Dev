<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Address extends Model
{
	use SoftDeletes;
	
	protected $fillable = [
		'name','division_id','district_id','upazila_id','union_id','phone', 'user_id','address','pin_code','defaddress','user_id','type'
	];
	
    public function getDivisions(){
    	return $this->belongsTo(Division::class, 'division_id')->withDefault();
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
    public function user(){
    	return $this->belongsTo('App\User','user_id','id')->withDefault();
    }

    public function getstate(){
    	return $this->belongsTo('App\Allstate','state_id','id')->withDefault();
	}
	
	public function getcity(){
    	return $this->belongsTo('App\Allcity','city_id','id')->withDefault();
	}
	
	public function getCountry(){
    	return $this->belongsTo(Allcountry::class,'country_id','id')->withDefault();
    }
}
