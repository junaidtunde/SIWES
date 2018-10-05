<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Company extends Authenticatable
{
    //
    protected $fillable = [
        'name',
        'username',
        'password',
        'RTC', 
        'address', 
        'supervisor_name', 
        'supervisor_email', 
        'supervisor_phone_number',
    ];
 
    protected $hidden = [
        'password', 'remember_token',
    ];
 
    protected $guard = 'companies';

    public function students()
    {
        return $this->hasMany('App\User');
    }
}
