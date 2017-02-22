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
            {{Form::label('contact_types', 'Types:')}}
            {{Form::select('contact_type[]', $contact_type, null, ['class'=>"js-example-basic-multiple form-control ", 'multiple'=>"multiple"])}}
            <div class="row">
                <a href="{{ route('contacts.show',$contact->id)}}" class="btn btn-danger col-md-6">Cancel</a>
                {{Form::submit('Update', array('class'=> 'btn btn-success  col-md-6'))}}
            </div>

            {!! Form::close() !!}
        </div>
    </div>

@endsection

@section('java')
    <script type="text/javascript">
        $(".js-example-basic-multiple").select2();
        $(".js-example-basic-multiple").val({!! json_encode( $contact->contact_type()->getRelatedIds()) !!}).trigger('change');
    </script>
@endsection