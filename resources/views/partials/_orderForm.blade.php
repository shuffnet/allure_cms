<?php

$date = Carbon::now()
?>


{!! Form::open(array('route' => 'orders.store', 'class'=>'')) !!}


{{Form::label('orderType_id','Order Type:')}}

<select name="orderType_id" id="orderType" class="form-control">
    <option value="" disabled selected>Select Order Type</option>
    @foreach($order_types as $order_type)
        <option value="{{$order_type->id}}">{{$order_type->type}}</option>
    @endforeach

</select>

{{Form::text('job_id', $job->id, array('class'=> 'form-control'))}}
{{Form::text('contact_id',$job->client_id, array('class'=> 'form-control'))}}
{{Form::date('orderDate', $date , array('class'=> 'form-control'))}}
{{Form::text('createdBy_id', 1, array('class'=> 'form-control'))}}


{{Form::submit('Save', array('class'=> 'btn btn-success btn-lg btn-block'))}}
{!! Form::close() !!}