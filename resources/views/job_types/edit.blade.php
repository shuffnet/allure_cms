@extends('main')

@section('content')

    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <h3>Edit Job type</h3>
            <hr>
            {!! Form::model($job_type, ['route'=>['job_types.update', $job_type->id], 'method'=> 'PUT']) !!}

            {{Form::label('type','Job Type:')}}
            {{Form::text('type', null, array('class'=> 'form-control'))}}
            <div class="col-sm-6">

                {{Form::submit('Update', array('class'=> 'btn btn-success btn-lg btn-block'))}}

            </div>
            {!! Form::close() !!}

            <div class="col-sm-6">
                {!! Form::open(['route' => ['job_types.destroy', $job_type->id], 'method'=>'DELETE']) !!}

                {{Form::submit('Delete', array('class'=> 'btn btn-danger  btn-block'))}}
                {!! Form::close() !!}
            </div>

        </div>
    </div>

@endsection