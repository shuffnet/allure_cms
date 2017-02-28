<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    //
    public function job(){

        return $this->belongsToMany('App\Job');


    }

    public function contact(){

        return $this->belongsToMany('App\Contact');
    }
}
