<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'roles';
    //
    public function job(){

        return $this->belongsToMany('App\Job');


    }

    public function contact(){

        return $this->belongsToMany('App\Contact');
    }

    public function default_contact(){

        return $this->belongsToMany('App\Contact','default_roles', 'contact_id', 'role_id');
    }
}
