<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Week extends Model
{
    //
    protected $fillable = ['name', 'end_of_week'];
    public function user()
    {
        return $this->belongsToMany('App\User');
    }

    public function posts()
    {
        return $this->hasMany('App\Post');
    }
}
