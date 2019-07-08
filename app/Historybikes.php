<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Historybikes extends Model
{
    protected $fillable = [
        'pk','biketable', 'employee_id', 'event', 'datetime'
    ];
    public $timestamps = false;
}
