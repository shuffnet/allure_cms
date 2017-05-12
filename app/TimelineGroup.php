<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TimelineGroup extends Model
{

    public function getgroupshots(){

    return $this->belongsToMany('App\ShotList','timeline_group_shots', 'timelinegroup_id', 'shot_list_id')->withPivot('id');





        }

    public function get_sessiontype(){

        return $this->belongsToMany('App\Session_Type','sessiontype_taskgroup', 'session_type_id', 'taskgroup_id')
            ->withPivot('id');



    }
}
