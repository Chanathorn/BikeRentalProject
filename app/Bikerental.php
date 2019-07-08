<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bikerental extends Model
{
    protected $fillable = [
        'rental_id', 'member_id', 'bike_id', 'repatriate','received','price','changecash','status_rental','employee_id'
    ];
    public function member(){
        return $this->belongsTo('App\Member', 'member_id', 'member_id');
     }
     public function bike(){
        return $this->belongsTo('App\Bike', 'bike_id', 'bike_id');
     }
     public function bikereturns(){
        return $this->hasMany('App\Bikereturn', 'rental_id', 'rental_id');
     }
    protected  $primaryKey = 'rental_id';
    public $incrementing = false;
}