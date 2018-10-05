<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Itf extends Authenticatable
{
    //
    protected $fillable = [
        'state',
        'LGA',
        'location',
    ];
 
    protected $hidden = [
        'password', 'remember_token',
    ];
 
    protected $guard = 'itfs';

    public function users()
    {
        return $this->hasMany('App\User');
    }
}
