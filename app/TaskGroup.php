<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TaskGroup extends Model
{
    //
    protected $table = 'taskgroup';

    public function get_task()
    {

        return $this->belongsToMany('App\TaskItem', 'taskgroup_taskitems', 'taskgroup_id', 'taskitems_id')
            ->withPivot('id');

    }


}
