<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    protected $fillable = [
        'member_id', 'name_member', 'lastname_member', 'gender_member', 'mobile_member','email_member','address_member','fee','employee_id'
    ];
    public function bikerentals(){
        return $this->hasMany('App\Bikerental', 'member_id', 'member_id');
     
    }
    public function bikereturns(){
        return $this->hasMany('App\Bikereturn', 'member_id', 'member_id');
     }
     public function user(){
        return $this->belongsTo('App\User', 'employee_id', 'employee_id');
     }
    protected  $primaryKey = 'member_id';
    public $incrementing = false;
}
