@extends('main')

@section('content')

    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <h3>Edit Contact type</h3>
            <hr>
            {!! Form::model($contact_type, ['route'=>['contact_types.update', $contact_type->id], 'method'=> 'PUT']) !!}

            {{Form::label('type','Contact Type:')}}
            {{Form::text('type', null, array('class'=> 'form-control'))}}
            <div class="col-sm-6">

                {{Form::submit('Update', array('class'=> 'btn btn-success btn-lg btn-block'))}}

            </div>
            {!! Form::close() !!}

            <div class="col-sm-6">
                {!! Form::open(['route' => ['contact_types.destroy', $contact_type->id], 'method'=>'DELETE']) !!}

                {{Form::submit('Delete', array('class'=> 'btn btn-danger  btn-block'))}}
                {!! Form::close() !!}
            </div>

        </div>
    </div>

@endsection