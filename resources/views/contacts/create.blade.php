@extends('main')

@section('content')

    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <h3>Create New Contact</h3>
            <hr>
            {!! Form::open(array('route' => 'contacts.store')) !!}

            {{Form::label('fname','First Name:')}}
            {{Form::text('fname', null, array('class'=> 'form-control'))}}


            {{Form::label('lname','Last Name:')}}
            {{Form::text('lname', null, array('class'=> 'form-control'))}}
            {{Form::label('email','Email:')}}
            {{Form::text('email', null, array('class'=> 'form-control'))}}
            {{Form::submit('Save', array('class'=> 'btn btn-success btn-lg btn-block'))}}
            {!! Form::close() !!}
        </div>
    </div>

@endsection

