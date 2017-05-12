@extends('main')

@section('content')

    <div class="row">
        <div class="col col-md-4">
            <h3>Session Types</h3>

            <table class="table">


                @foreach($types as $type)
                    <tr  class="well">
                        <td><a href="{{ route('session_type.show', $type->id)}}">Edit</a></td>

                        <td> {!! Form::open(['route' => ['session_type.destroy', $type->id], 'method'=>'DELETE']) !!}

                            {{Form::submit('Delete', array('class'=> 'btn btn-link btn-md'))}}
                            {!! Form::close() !!}</td>



                        </td>
                        <td>{{$type->type}}</td>
                    </tr>



                @endforeach

            </table>





        </div>

        <div id="" class="col col-md-4 ">

            <h3>Create Session Type</h3>
            <hr>
            {!! Form::open(array('route' => 'session_type.store')) !!}

            {{Form::label('type','Session Type:')}}
            {{Form::text('type', null, array('class'=> 'form-control'))}}

                {{Form::label('taskgroup','Select Task Groups:')}}

            <select name='taskgroup[]'class="task-group form-control" multiple="multiple">

                @foreach($groups as $group)
                    <option value="{{$group->id}}">{{$group->group}}</option>
                @endforeach
            </select>

            {{Form::submit('Save', array('class'=> ' btn btn-success btn-lg btn-block'))}}
            {!! Form::close() !!}
        </div>





    </div>


    </div>

@stop
@section('java')
    <script type="text/javascript">
        $(".task-group").select2();
    </script>

@stop
