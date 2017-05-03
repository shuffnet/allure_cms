<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{

    public function job_type(){

        return $this->belongsTo('App\JobType');

    }




    public function role(){

        return $this->belongsToMany('App\Role','job_role', 'job_id', 'role_id')
            ->withPivot('contact_id');

//

    }
    public function contact(){

        return $this->belongsToMany('App\Contact');
    }

    public function order(){

        return $this->hasMany('App\Order');
    }
    public function timeline(){
        return $this->hasMany('App\Timeline');
    }
    public function get_shots()
    {
        return $this->hasManyThrough('App\Timeline', 'App\JobTimelineShots');
    }
    public function sessions(){
        return $this->hasMany('App\Session' ,'job_id', 'id' );
    }

}
