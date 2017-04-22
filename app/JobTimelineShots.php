<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JobTimelineShots extends Model
{
    //
    protected $table = 'jobtimelineshots';
    protected $fillable = ['job_id', 'duration', 'time','shortTime ','shot', 'tips', 'timeline_id'];
    public function get_details(){

        return $this->hasMany('App\JobTimelineDetails','jobtimelineshots_id', 'id');


    }

}

