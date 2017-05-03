<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Session_Type extends Model
{
    //
    public function session_type(){
        return $this->hasMany('App\Session'  );
    }
}
