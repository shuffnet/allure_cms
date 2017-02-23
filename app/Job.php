<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    //
    public function job_type(){

        return $this->belongsTo('App\JobType');

    }

    public function contacts(){

        return $this->belongsToMany('App\Contact', 'contact_job', 'contact_id', 'job_id');
    }





}
