@extends('main')

@section('content')


    <div class="row">


        <div class="col col-md-4 col-md-offset-3">




                        <h4 class="modal-title">Create New Time Line</h4>
                        {!! Form::open(array('route' => 'timeline.store')) !!}

                        {{Form::label('name','Timeline Name:')}}
                        {{Form::text('name', null, array('class'=> 'form-control'))}}


                        {{Form::label('howMuchTime','Number Of Hours Purchased:')}}
                        {{Form::text('howMuchTime', null, array('class'=> 'form-control'))}}
                        {{Form::label('jobDate','Ceremony Date:')}}
                        {{Form::date('jobDate', '', array('class'=> 'form-control'))}}
                        {{Form::label('ceremonytime','Ceremony Start Time:')}}
                        {{Form::time('ceremonytime', '', array('class'=> 'form-control'))}}

                        {{Form::label('ceremonyendtime','Ceremony End Time:')}}
                        {{Form::time('ceremonyendtime', '', array('class'=> 'form-control'))}}
                        {{Form::text('job_id', $job, array('class'=>'form-control'))}}


                        {{Form::submit('Save', array('class'=> 'btn btn-success btn-lg btn-block'))}}
                        {!! Form::close() !!}


            </div>






    </div>













@endsection
@section('java')



@stop

