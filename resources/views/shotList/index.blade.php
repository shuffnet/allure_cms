@extends('main')

@section('content')

    <div class="row">
        <div class="col col-md-4">
            <h3>Shots</h3>

                <table class="table">


                    @foreach($shots as $shot)
                        <tr  class="well">
                            <td style=""><a href="{{ route('shotList.edit', $shot->id)}}">Edit</a></td>
                            <td><a href="{{ route('shotDelete.delete', $shot->id)}}">Delete</a></td>
                            <td>{{$shot->name}}</td>
                        </tr>
                        <tr class="hidden"><td class=""><ul class="">@foreach ($shot->get_shots as $shotList)<li>{{$shotList->shot}}</li>@endforeach</ul></td><td class="hidden">{{$shot->tips}}</td><td class="hidden">{{$shot->time}}</td></tr>



                    @endforeach

                </table>





        </div>

        <div id="" class="col col-md-4 ">

            <h3>Create New Group</h3>
            <hr>
            {!! Form::open(array('route' => 'shotList.store')) !!}

            {{Form::label('name','Group Name:')}}
            {{Form::text('name', null, array('class'=> 'form-control'))}}
            <div id="shotbtn" class="btn btn-warning">Add Shots</div>
            {{--{{Form::label('shots','Shots:')}}--}}
            {{--{{Form::text('shots[]', null, array( 'id'=>'shots','class'=> 'form-control'))}}--}}
            <div id="wrapper"></div>


            {{Form::label('tips','Tips:')}}
            {{Form::textarea('tips', null, array('class'=> 'form-control'))}}
            {{Form::label('time','How many minutes?')}}
            {{Form::text('time', null, array('class'=> 'form-control'))}}




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
