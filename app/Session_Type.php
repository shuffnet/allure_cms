<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Session_Type extends Model
{
    //
    public function session_type(){
        return $this->hasMany('App\Session'  );
    }
    public function get_taskgroup(){

        return $this->belongsToMany('App\TaskGroup','sessiontype_taskgroups', 'session_types_id', 'taskgroup_id')
            ->withPivot('id');



    }
}
