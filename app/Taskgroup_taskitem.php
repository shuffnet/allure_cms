<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class Taskgroup_taskitem extends Model
{
    //
    public $timestamps = false;
    protected $table = 'taskgroup_taskitems';
}
