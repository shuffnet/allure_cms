<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JobTimelineDetails extends Model
{
    //
    protected $table = 'job_timeline_details';
    protected $fillable = ['detail', 'jobtimelineshots_id', 'note'];

}
