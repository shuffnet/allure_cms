@extends('main')

@section('content')

    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <h3>Edit Role</h3>
            <hr>
            {!! Form::model($role, ['route'=>['roles.update', $role->id], 'method'=> 'PUT']) !!}

            {{Form::label('role','Role:')}}
            {{Form::text('role', null, array('class'=> 'form-control'))}}
            <div class="col-sm-6">

                {{Form::submit('Update', array('class'=> 'btn btn-success btn-lg btn-block'))}}

            </div>
            {!! Form::close() !!}

            <div class="col-sm-6">
                {!! Form::open(['route' => ['roles.destroy', $role->id], 'method'=>'DELETE']) !!}

                {{Form::submit('Delete', array('class'=> 'btn btn-danger  btn-block'))}}
                {!! Form::close() !!}
            </div>

        </div>
    </div>

@endsection