<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ShotList extends Model
{
    //
    public function get_shots(){

        return $this->hasMany('App\ShotlistShots');

    }

}
