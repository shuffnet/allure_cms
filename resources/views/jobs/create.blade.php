@extends('main')

@section('content')

    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <h3>Create New Job</h3>
            <hr>
            {!! Form::open(array('route' => 'jobs.store')) !!}

            {{Form::label('job_type_id','Job Type:')}}
            {{--{{Form::text('type', null, array('class'=> 'form-control'))}}--}}
            <select name="job_type_id" id="" class="form-control">
                <option value="" disabled selected>Select Job Type</option>
                @foreach($job_types as $job_type)
                    <option value="{{$job_type->id}}">{{$job_type->type}}</option>
                @endforeach

            </select>

            {{Form::label('name','Job Name:')}}
            {{Form::text('name', null, array('class'=> 'form-control'))}}
            {{Form::label('description','Job Description:')}}
            {{Form::textarea('description', null, array('class'=> 'form-control'))}}
            {{Form::submit('Save', array('class'=> 'btn btn-success btn-lg btn-block'))}}
            {!! Form::close() !!}
        </div>
    </div>

@endsection

{{--@section('java')--}}
    {{--<script>--}}

        {{--$('#select').on('change', function(){--}}

            {{--$value = $('#select').val()--}}
            {{--alert($value);--}}

        {{--})--}}




    {{--</script>--}}

{{--@endsection--}}