@extends('main')

@section('content')

    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <h3>Edit Contact</h3>
            <hr>
            {!!Form::model($contact, ['route'=>['contacts.update', $contact->id], 'method'=> 'PUT']) !!}
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            {{Form::label('fname','First:')}}
            {{Form::text('fname', null, ['class'=>'form-control']) }}
            {{Form::label('lname','Last:')}}
            {{Form::text('lname', null, array('class'=> 'form-control'))}}
            {{Form::label('email','Email:')}}
            {{Form::text('email', null, array('class'=> 'form-control'))}}
            {{Form::label('phone','Phone:')}}
            {{Form::text('phone',null, ['class'=>'form-control'])}}
            {{Form::label('contact_types', 'Types:')}}

            {{Form::select('contact_type[]', $contact_type, null, ['class'=>"js-example-basic-multiple form-control ", 'multiple'=>"multiple"])}}

            {{Form::label('default_role', 'Default Roles:')}}

            {{Form::select('default_role[]', $contact_type, null, ['class'=>"default-role form-control ", 'multiple'=>"multiple"])}}

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
        $(".default-role").select2();
        $(".default-role").val({!! json_encode( $contact->default_role()->getRelatedIds()) !!}).trigger('change');

    </script>
@endsection