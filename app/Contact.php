<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    //

    public function contact_type(){

        return $this->belongsToMany('App\Contact_Type');
    }
}
