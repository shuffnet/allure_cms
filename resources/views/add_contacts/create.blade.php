@extends('main')

@section('content')

    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <h3>Create New Contact</h3><small>for {{$request->$job}}</small>
            <hr>
            {!! Form::open(array('route' => 'add_contacts.store')) !!}

            {{Form::label('fname','First Name:')}}
            {{Form::text('fname', null, array('class'=> 'form-control'))}}


            {{Form::label('lname','Last Name:')}}
            {{Form::text('lname', null, array('class'=> 'form-control'))}}
            {{Form::label('email','Email:')}}
            {{Form::text('email', null, array('class'=> 'form-control'))}}

            {{--{{Form::label('contact_type','Roles:')}}--}}
            {{--<select name='contact_type[]'class="contact-type form-control" multiple="multiple">--}}
                {{--@foreach($contact_types as $contact_type)--}}
                    {{--<option value="{{$contact_type->id}}">{{$contact_type->type}}</option>--}}
                {{--@endforeach--}}
            {{--</select>--}}
            {{Form::submit('Save', array('class'=> 'btn btn-success btn-lg btn-block'))}}
            {!! Form::close() !!}
        </div>
    </div>

@endsection

{{--@section('java')--}}
    {{--<script type="text/javascript">--}}
        {{--$(".contact-type").select2();--}}
    {{--</script>--}}
{{--@endsection--}}