@extends('main')

@section('content')

    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <h3>Create New Contact</h3>
            <hr>
            {!! Form::open(array('route' => 'contacts.store')) !!}
            <input type="hidden" name="_token" value="{{ csrf_token() }}">

            {{Form::label('fname','First Name:')}}
            {{Form::text('fname', null, array('class'=> 'form-control'))}}


            {{Form::label('lname','Last Name:')}}
            {{Form::text('lname', null, array('class'=> 'form-control'))}}
            {{Form::label('email','Email:')}}
            {{Form::text('email', null, array('class'=> 'form-control'))}}
            {{Form::label('phone','Phone:')}}
            {{Form::text('phone', null, array('id'=>'cell-phone','class'=> 'form-control'))}}

            {{Form::label('contact_type','Roles:')}}
            <select name='contact_role[]'class="contact-type form-control" multiple="multiple">

                @foreach($roles as $role)
                    <option value="{{$role->id}}">{{$role->role}}</option>
                @endforeach
            </select>
            {{Form::label('default_role','Default Roles:')}}
            <select name='default_role[]'class="default-type form-control" multiple="multiple">

                @foreach($roles as $role)
                    <option value="{{$role->id}}">{{$role->role}}</option>
                @endforeach
            </select>
            {{Form::submit('Save', array('class'=> 'btn btn-success btn-lg btn-block'))}}
            {!! Form::close() !!}
        </div>
    </div>

@endsection

@section('java')
    {!! Html::script('js/jquery.maskedinput.min.js') !!}

    <script type="text/javascript">

        $('#cell-phone').mask('(999) 999-9999');
        $('#secondary-phone').mask('a(999) 999-9999?ex9999');
        $('#spousePhone').mask('a(999) 999-9999?ex9999');
        $('#emergencyPhone').mask('a(999) 999-9999?ex9999');

    </script>

    <script type="text/javascript">
        $(".contact-type").select2();
        $(".default-type").select2();
    </script>
@endsection