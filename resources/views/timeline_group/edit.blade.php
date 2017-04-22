@extends('main')

@section('content')

    <div class="row">
        <div class="col col-md-4">






        </div>

        <div id="" class="col col-md-4 ">

            <h3>Edit Group</h3>
            <hr>
            {!! Form::model($group, ['route'=>['timelinegroup.update', $group->id], 'method'=> 'PUT']) !!}


            {{Form::label('group','Group Name:')}}
            {{Form::text('group', null, array('class'=> 'form-control'))}}



            {{Form::submit('Update', array('class'=> 'btn btn-success btn-lg btn-block'))}}
            {!! Form::close() !!}
        </div>





    </div>


    </div>

@stop
@section('java')

@stop
