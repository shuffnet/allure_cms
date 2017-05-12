<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
    //
    public function get_type(){

        return $this->belongsTo('App\Session_Type', 'session_type_id');

    }
    public function get_photographer(){

        return $this->belongsTo('App\Contact', 'photographer_id');

    }

    public function get_task(){
        return $this->hasMany('App\Task', 'session_id');
    }





}
