<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    //
    public function job_type(){

        return $this->belongsTo('App\JobType');

    }

//    public function contact(){
//
//        return $this->belongsToMany('App\Contact','job_role', 'id', 'contact_id');
//    }
//

    public function role(){

        return $this->belongsToMany('App\Role','job_role', 'job_id', 'role_id')
            ->withPivot('contact_id');

//

    }
    public function contact(){

        return $this->belongsToMany('App\Contact');
    }



}
