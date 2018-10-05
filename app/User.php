<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'firstname', 
        'lastname', 
        'matric_no', 
        'email', 
        'password',
        'state',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function company()
    {
        return $this->belongsTo('App\Company');
    }

    public function week()
    {
        return $this->hasMany('App\Week');
    }

    public function itf()
    {
        return $this->belongsTo('App\Itf');
    }

    public function supervisor()
    {
        return $this->belongsTo('App\Supervisor');
    }
}
