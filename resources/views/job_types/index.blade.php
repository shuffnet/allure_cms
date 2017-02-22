@extends('main')

@section('content')

    <div class="row">
        <div class="col col-md-4">
            <h3>Job Types</h3>

            <table class="table">
                <thead>
                    <th>Type</th>
                    <th></th>
                    <th></th>
                </thead>
                <tbody>
                @foreach($job_types as $job_type)
                    <tr><td>{{$job_type->type}}</td><td><a href="{{ route('job_types.edit', $job_type->id) }}">edit</tr>

                @endforeach

                </tbody>



            </table>



        </div>

        <div class="col col-md-4">

            <h3>Create New Job/Type</h3>
            <hr>
            {!! Form::open(array('route' => 'job_types.store')) !!}

            {{Form::label('type','Type:')}}
            {{Form::text('type', null, array('class'=> 'form-control'))}}

            {{Form::submit('Save', array('class'=> 'btn btn-success btn-lg btn-block'))}}
            {!! Form::close() !!}
        </div>





        </div>


    </div>

@stop
