<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bikereturn extends Model
{
    protected $fillable = [
        'return_id','member_id', 'rental_id', 'bike_id', 'return_date',	'received', 'fine','changecash','employee_id'
    ];
    public function member(){
        return $this->belongsTo('App\Member', 'member_id', 'member_id');
     }
     public function bike(){
        return $this->belongsTo('App\Bike', 'bike_id', 'bike_id');
     }
     public function bikerentals(){
        return $this->belongsTo('App\Bikerental', 'rental_id', 'rental_id');
     }
    protected  $primaryKey = 'return_id';
    public $incrementing = false;
   //ทำการรีเลชั่น
}
