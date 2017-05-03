<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    //

    public function contact_type(){


        return $this->belongsToMany('App\Role', 'contact_role', 'contact_id','role_id'  );
    }

    public function jobs() {

        return $this->belongsToMany('App\Job', 'contact_job', 'role_id', 'job_id');
    }

    public function role(){

        return $this->belongsToMany('App\Role','job_role', 'job_id', 'role_id')
            ->withPivot('contact_id');



    }

    public function get_sessions() {
        return $this->belongsTo('App\Session', 'contact_id');
    }


}
