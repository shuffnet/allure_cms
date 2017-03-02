@extends('main')

@section('content')

    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <h3>Create New Contact</h3><small> {{$job}}</small>
            <hr>
            {!! Form::open(array('route' => 'add_contacts.store')) !!}
            {{Form::text('id',$job, ['class'=>'hidden'])}}
            <select name='role[]'class=" form-control" >
                <option value="" disabled selected>Select Contact Role</option>
                @foreach($roles as $role)
                    <option value="{{$role->id}}">{{$role->role}}</option>
                @endforeach
            </select>
            {{Form::label('fname','First Name:')}}
            {{Form::text('fname', null, array('class'=> 'form-control'))}}


            {{Form::label('lname','Last Name:')}}
            {{Form::text('lname', null, array('class'=> 'form-control'))}}
            {{Form::label('email','Email:')}}
            {{Form::text('email', null, array('class'=> 'form-control'))}}
            {{Form::label('phone','Phone:')}}
            {{Form::text('phone', null, array('id'=>'cell-phone','class'=> 'form-control'))}}
            <hr>



            {{Form::submit('Save', array('class'=> 'btn btn-success btn-lg btn-block'))}}
            {!! Form::close() !!}
        </div>
    </div>

@endsection

@section('java')
    {!! Html::script('js/jquery.maskedinput.min.js') !!}
    {{--<script type="text/javascript">--}}
        {{--$(".contact-type").select2();--}}
    {{--</script>--}}
    <script type="text/javascript">

        $('#cell-phone').mask('(999) 999-9999');
        $('#secondary-phone').mask('a(999) 999-9999?ex9999');
        $('#spousePhone').mask('a(999) 999-9999?ex9999');
        $('#emergencyPhone').mask('a(999) 999-9999?ex9999');

    </script>
@endsection