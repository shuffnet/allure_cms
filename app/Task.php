<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    //
    public function get_contact(){

        return $this->belongsTo('App\Contact', 'contact_id');

    }
}
