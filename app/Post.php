<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //
    protected $fillable = ['day_of_week', 'content'];
    public function week()
    {
        return $this->belongsToMany('App\Week');
    }
}
