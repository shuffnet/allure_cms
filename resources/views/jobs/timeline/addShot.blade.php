@extends('main')

@section('content')

    <div class="row">
        <div class="col col-md-4">






        </div>

        <div id="" class="col col-md-4 ">

            <h3>Add Shot To Time Line</h3>
            <hr>
            {!! Form::model($shot, ['route'=>['shotList.update', $shot->id], 'method'=> 'PUT']) !!}


            {{Form::label('name','Group Name:')}}
            {{Form::text('name', null, array('class'=> 'form-control'))}}
            <div id="shotbtn" class="btn btn-warning">Add Shots</div>
            <table class="table">
                @foreach ($shot->get_shots as $shotList)

                    <tr><td><a href="{{route('shotListDelete.delete', $shotList->id)}}" class="btn btn-link deleteShot">Delete</a></td><td>{{$shotList->id}}</td><td>{{$shotList->shot}}</td></tr>


                @endforeach
            </table>

            <div id="wrapper"></div>


            {{Form::label('tips','Tips:')}}
            {{Form::textarea('tips', null, array('class'=> 'form-control'))}}
            {{Form::label('time','How many minutes?')}}
            {{Form::text('time', null, array('class'=> 'form-control'))}}




            {{Form::submit('Update', array('class'=> 'btn btn-success btn-lg btn-block'))}}
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



        });
        $('.deleteShot').on('click', function(){

            alert($this.closest(td.eq(0).text));
        })

    </script>
@stop
