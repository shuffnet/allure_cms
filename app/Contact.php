<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    //

    public function contact_type(){


        return $this->belongsToMany('App\Contact_Type', 'contact_contactType', 'contact_id','contactType_id'  );
    }

    public function jobs() {

        return $this->belongsToMany('App\Job', 'contact_job', 'contact_id', 'job_id');
    }

    public function role(){

        return $this->belongsToMany('App\Role','job_role', 'job_id', 'role_id')
            ->withPivot('contact_id');



    }




}
