@extends('main')

@section('content')

    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <h3>Edit Contact</h3>
            <hr>
            {!! Form::model($contact, ['route'=>['contacts.update', $contact->id], 'method'=> 'PUT']) !!}

            {{Form::label('fname','First:')}}
            {{Form::text('fname', null, ['class'=>'form-control']) }}
            {{Form::label('lname','Last:')}}
            {{Form::text('lname', null, array('class'=> 'form-control'))}}
            {{Form::label('email','Email:')}}
            {{Form::textarea('email', null, array('class'=> 'form-control'))}}
            <div class="row">
                <a href="{{ route('contacts.show',$contact->id)}}" class="btn btn-danger col-md-6">Cancel</a>
                {{Form::submit('Update', array('class'=> 'btn btn-success  col-md-6'))}}
            </div>

            {!! Form::close() !!}
        </div>
    </div>

@endsection