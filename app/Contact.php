<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    //

    public function contact_type(){


        return $this->belongsToMany('App\Contact_Type', 'contact_contactType', 'contactType_id', 'contact_id' );
    }

    public function jobs() {

        return $this->belongsToMany('App\Job', 'contact_job', 'contact_id', 'job_id');
    }




}
