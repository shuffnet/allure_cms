@extends('main')

@section('content')

    <div class="row">
        <div class="col col-md-5">
            <h3>Groups</h3>

            <table class="table">


                @foreach($groups as $group)
                    <tr  class="well">
                        <td style=""><a href="{{ route('timelinegroup.edit', $group->id)}}">Edit</a></td>
                        <td>
                            <div class="col col-md-2">

                                {!! Form::open(['route' => ['timelinegroup.destroy', $group->id], 'method'=>'DELETE']) !!}

                                {{Form::submit('Delete', array('class'=> 'btn btn-link btn-md'))}}
                                {!! Form::close() !!}




                        <td>
                            <a class="col col-md-8" href="{{ route('timelinegroup.show', ['groupid' => $group->id])}}"><h4>{{$group->group}}</h4></a>
                        </td>
                    </tr>



                @endforeach

            </table>





        </div>

        <div id="" class="col col-md-4 ">

            <h3>Create New Group</h3>
            <hr>
            {!! Form::open(array('route' => 'timelinegroup.store')) !!}

            {{Form::label('group','Group Name:')}}
            {{Form::text('group', null, array('class'=> 'form-control'))}}

            {{Form::submit('Save', array('class'=> 'btn btn-success btn-lg btn-block'))}}
            {!! Form::close() !!}
        </div>





    </div>


    </div>

@stop
@section('java')
    <script>

        $('#shotbtn').on('click', function(){



//            $('#tblShots').append('<tr><td "><div class="btn btn-link btn-sm">Remove</div></td><td class="">'+$shot+'</td></tr>');


            $('#wrapper').append('<div><input class="form-control" name="shots[]"</div>');



        })

    </script>
@stop
