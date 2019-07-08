<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bike extends Model
{
    protected $fillable = [
        'bike_id', 'brand', 'generation', 'type_id', 'status_id'
    ];
    
    public function bikeprice(){
        return $this->belongsTo('App\Bikeprice', 'type_id', 'type_id');
     }
     public function bikestatus(){
        return $this->belongsTo('App\Bikestatus', 'status_id', 'status_id');
     }
     public function bikerentals(){
        return $this->hasMany('App\Bikerental', 'bike_id', 'bike_id');
     }
     public function bikereturns(){
        return $this->hasMany('App\Bikereturn', 'bike_id', 'bike_id');
     }
    protected  $primaryKey = 'bike_id';
    public $incrementing = false;

  
}
