<?php
use Carbon\Carbon;
$date = Carbon::now()
?>


{!! Form::open(array('route' => 'orders.store')) !!}

{{Form::label('type','Type:')}}
{{Form::text('orderType_id', null, array('class'=> 'form-control'))}}
{{Form::text('job_id', $job->id, array('class'=> 'form-control'))}}
{{Form::text('contact_id', null, array('class'=> 'form-control'))}}
{{Form::date('orderDate', $date , array('class'=> 'form-control'))}}
{{Form::text('createdBy_id', 1, array('class'=> 'form-control'))}}


{{Form::submit('Save', array('class'=> 'btn btn-success btn-lg btn-block'))}}
{!! Form::close() !!}