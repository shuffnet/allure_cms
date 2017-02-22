@extends('main')

@section('content')

    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <h3>Edit Job</h3>
            <hr>
            {!! Form::model($job, ['route'=>['jobs.update', $job->id], 'method'=> 'PUT']) !!}

            {{Form::label('job_type_id','Job Type:')}}
            {{Form::Select('job_type_id', $job_types, null, ['class'=>'form-control']) }}
            {{Form::label('name','Job Name:')}}
            {{Form::text('name', null, array('class'=> 'form-control'))}}
            {{Form::label('description','Job Description:')}}
            {{Form::textarea('description', null, array('class'=> 'form-control'))}}
            <div class="row">
                <a href="{{ route('jobs.show',$job->id)}}" class="btn btn-danger col-md-6">Cancel</a>
                {{Form::submit('Update', array('class'=> 'btn btn-success  col-md-6'))}}
            </div>

            {!! Form::close() !!}
        </div>
    </div>

@endsection