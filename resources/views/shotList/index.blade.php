@extends('main')

@section('content')

    <div class="row">
        <div class="col col-md-4">
            <h3>Shots</h3>

                <table>


                    @foreach($shots as $shot)
                        <tr class="well"><td>{{$shot->name}}</td><td><div class="btn btn-link">Pre</div></td><td><div class="btn btn-link">Post</div></td></tr>
                        <tr><td class=""><ul class="">{!! $shot->shots !!}</ul></td><td class="hidden">{{$shot->tips}}</td><td class="hidden">{{$shot->time}}</td></tr>







                    @endforeach
                </table>




        </div>

        <div class="col col-md-4 ">

            <h3>Create New Group</h3>
            <hr>
            {!! Form::open(array('route' => 'shotList.store')) !!}

            {{Form::label('name','Group Name:')}}
            {{Form::text('name', null, array('class'=> 'form-control'))}}
            <input type="text" id="shot"><div id="shotbtn" class="btn btn-default">Add</div>
            {{Form::label('shots','Shots:')}}
            {{Form::textarea('shots', null, array( 'id'=>'shots','class'=> 'form-control'))}}
            {{Form::label('tips','Tips:')}}
            {{Form::textarea('tips', null, array('class'=> 'form-control'))}}
            {{Form::label('time','How many minutes?')}}
            {{Form::text('time', null, array('class'=> 'form-control'))}}
            {{Form::label('order','Order:')}}
            {{Form::text('order', null, array('class'=> 'form-control'))}}


            {{Form::submit('Save', array('class'=> 'btn btn-success btn-lg btn-block'))}}
            {!! Form::close() !!}
        </div>





    </div>


    </div>

@stop
@section('java')
    <script>
        $('#shotbtn').on('click', function(){
            var $shots = $('#shots').text();
           var $shot = $('#shot').val();
          $('#shots').text($shots+"<li>"+$shot+"</li>");
           $('#shot').val('');

        })

    </script>
    @stop
