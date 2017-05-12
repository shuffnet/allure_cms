@extends('main')

@section('content')

    <div class="row">
        <div class="col col-md-4">
            <h3>Groups</h3>

            <table class="table">
                <thead>
                <th>Task</th>
                <th></th>
                <th></th>
                </thead>
                <tbody>
                @foreach($groups as $group)
                    <tr>
                        <td> {!! Form::open(['route' => ['taskgroup.destroy', $group->id], 'method'=>'DELETE']) !!}

                            {{Form::submit('Delete', array('class'=> 'btn btn-link btn-md'))}}
                            {!! Form::close() !!}</td>
                        <td><a href="{{ route('taskgroup.show', $group->id)}}">{{$group->group}}</a></td>
                    </tr>

                @endforeach

                </tbody>



            </table>



        </div>

        <div class="col col-md-4">

            <h3>Create New Group</h3>
            <hr>
            {!! Form::open(array('route' => 'taskgroup.store')) !!}

            {{Form::label('group','Group:')}}
            {{Form::text('group', null, array('class'=> 'form-control'))}}


            {{Form::submit('Save', array('class'=> 'btn btn-success btn-lg btn-block'))}}
            {!! Form::close() !!}
        </div>





    </div>


    </div>

@stop
