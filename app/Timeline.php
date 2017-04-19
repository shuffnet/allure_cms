<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Timeline extends Model
{
    //
    public function timeline_shots(){
        return $this->hasMany('App\JobTimelineShots');
    }
}
