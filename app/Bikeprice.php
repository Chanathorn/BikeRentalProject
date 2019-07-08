<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bikeprice extends Model
{
    protected $fillable = [
        'type_id', 'bike_type', 'price'
    ];

    public function bikes()
    {
        return $this->hasMany('App\Bike', 'type_id', 'type_id');
    }
    protected  $primaryKey = 'type_id';
    public $incrementing = false;
}
