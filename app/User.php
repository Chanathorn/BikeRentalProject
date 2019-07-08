<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    const ADMIN_TYPE = 1;
    const DEFAULT_TYPE = 0;
    public function isAdmin()
    {
        return $this->type === self::ADMIN_TYPE;
    } 
    public function member(){
        return $this->hasMany('App\Member', 'employee_id', 'employee_id');
     }
    protected  $primaryKey = 'employee_id';
    public $incrementing = false;
    protected $fillable = [
        'employee_id','name','lastname','gender', 'mobile', 'address','email', 'password'
    ];
 
    protected $hidden = [
        'password', 'remember_token',
    ];
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
