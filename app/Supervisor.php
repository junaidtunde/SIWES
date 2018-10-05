<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Supervisor extends Authenticatable
{
    //
    protected $fillable = [
        'name',
        'username',
        'password',
        'school_name',
        'school_address',
        'email',
    ];
 
    protected $hidden = [
        'password', 'remember_token',
    ];
 
    protected $guard = 'supervisors';

    public function users()
    {
        return $this->hasMany('App\User');
    }
}
