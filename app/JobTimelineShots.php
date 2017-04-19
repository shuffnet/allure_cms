<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JobTimelineShots extends Model
{
    //
    protected $table = 'jobtimelineshots';
    protected $fillable = ['job_id', 'duration', 'time','shortTime ','shot', 'tips', 'timeline_id'];
}
