<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TaskItem extends Model
{
    //
    protected $table = 'taskitems';

    protected $fillable = ['task', 'dueDateRules_id', 'dueDateRulesTime'];

    public function get_group()
    {
        return $this->belongsToMany('App\TaskGroup', 'taskgroup_taskitem', 'taskitems_id', 'taskgroup_id');
    }

}
