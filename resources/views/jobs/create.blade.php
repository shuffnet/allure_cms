@extends('main')

@section('content')

    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <h3>Create New Job</h3>
            <hr>
            {!! Form::open(array('route' => 'jobs.store')) !!}
            {{--//create the client first--}}

            {{Form::label('fname','First Name:')}}
            {{Form::text('fname', null, array('class'=> 'form-control'))}}


            {{Form::label('lname','Last Name:')}}
            {{Form::text('lname', null, array('class'=> 'form-control'))}}
            {{Form::label('email','Email:')}}
            {{Form::text('email', null, array('class'=> 'form-control'))}}

            {{Form::label('contact_type','Roles:')}}
            <select name='contact_type[]'class="contact-type form-control" multiple="multiple">
                @foreach($contact_types as $contact_type)
                    <option value="{{$contact_type->id}}">{{$contact_type->type}}</option>
                @endforeach
            </select>

            {{--now create the job--}}

            {{Form::label('job_type_id','Job Type:')}}

            <select name="job_type_id" id="jobType" class="form-control">
                <option value="" disabled selected>Select Job Type</option>
                @foreach($job_types as $job_type)
                    <option value="{{$job_type->id}}">{{$job_type->type}}</option>
                @endforeach

            </select>
            {{Form::label('date', "Job Date:")}}
            {{Form::date('date', null, array('id'=>'jobDate','class'=> 'form-control'))}}
            {{Form::label('name','Job Name:')}}
            {{Form::text('name', null, array('class'=> 'form-control'))}}
            {{Form::label('description','Job Description:')}}
            {{Form::textarea('description', null, array('class'=> 'form-control'))}}
            {{Form::submit('Save', array('class'=> 'btn btn-success btn-lg btn-block'))}}
            {!! Form::close() !!}
        </div>
    </div>

@endsection


@section('java')
    <script type="text/javascript">
        $(".contact-type").select2();
        $("#jobDate").on('change', function(){
            var fname = $("[name='fname']").val();
            var lname = $("[name='lname']").val();
           var type = $("#jobType option:selected").text();
           var date = $("[name='date']").val();



            $("[name='name']").val(fname + " " + lname + " " + type  );

        });

    </script>
@endsection