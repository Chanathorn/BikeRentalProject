<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bikestatus extends Model
{
    protected $fillable = [
        'status_id','status'
    ];
     
    public function bikes(){
        return $this->hasMany('App\Bike', 'type_id', 'type_id');
     } 
    protected  $primaryKey = 'status_id';
    public $incrementing = false;
}
