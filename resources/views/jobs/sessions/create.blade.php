@extends('main')

@section('content')

    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <h3>Create New Session</h3>
            <hr>
            {!! Form::open(array('route' => 'session.store')) !!}

            <select name="session_type_id" id="session_type"  class="form-control">
                <option value="" disabled selected>Select Session Type</option>
                @foreach($session_types as $session_type)
                    <option value="{{$session_type->id}}">{{$session_type->type}}</option>
                @endforeach

            </select>

            {{Form::label('date','Session Date:')}}
            {{Form::date('date', null, array('id'=>'datepicker','class'=> ''))}}
            {{Form::label('time','Session Time:')}}
            {{Form::time('time', null, array('class'=> ''))}}

            {{Form::label('job_id','Job ID:',  array('class'=> 'hidden form-control'))}}
            {{Form::text('job_id', $job, array('class'=> 'hidden form-control'))}}
            {{Form::label('photographer_id','Photographer ID:',['class'=>'hidden'])}}
            {{Form::text('photographer_id',$lead, array('class'=> 'hidden form-control'))}}
            {{Form::label('location','Location:')}}
            {{Form::text('location', null, array('class'=> 'form-control'))}}
            {{Form::label('notes','Notes:')}}
            {{Form::textarea('notes', null, array('class'=> 'form-control'))}}
            {{Form::label('photog','Photographer:')}}
            <select name="photog" id="" class="photog form-control">
                {{--<option value=""class="photog" disabled selected>Select Photographer</option>--}}
                @foreach($photogs as $photog)
                    <option value="{{$photog->id}}">{{$photog->fname." ".$photog->lname}}</option>
                @endforeach

            </select>
            {{--{{Form::select('photog_id', $photog->id, null, ['class'=>"photog form-control "])}}--}}





            {{Form::submit('Save', array('class'=> 'btn btn-success btn-lg btn-block'))}}
            {!! Form::close() !!}
        </div>
    </div>

@endsection


@section('java')
    <script type="text/javascript">
        $(".photog").select2();
        $(".photog").val({!! json_encode($lead)!!}).trigger('change');




    </script>


@endsection