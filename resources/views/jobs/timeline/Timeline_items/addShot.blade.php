@extends('main')

@section('content')

    <div class="row">
        <div class="col col-md-4">






        </div>


        <div id="" class="col col-md-5 ">
            <h3>Add Shot</h3>
            <hr>
            {!! Form::model($shot, ['route'=>['jobtimeline.store'], 'method'=> 'POST']) !!}
            {{Form::text('timeline_id',$timeline, array('class'=> 'form-control'))}}
            {{Form::text('job_id',$job, array('class'=> 'form-control'))}}



            <hr>


            <select class="form-control" name="photographer" id="">
                <option class="form-control" value="1"> Lead Photographer</option>
                <option class="form-control" value="2"> Second Photographer</option>



            </select>

            <input   type="radio" name="pre" value="1"> Pre Ceremony<br>
            <input   type="radio" name="pre" value="2"> Post Ceremony<br>


            {{Form::label('name','Group Name:')}}
            {{Form::text('name', null, array('class'=> 'form-control'))}}
            <hr>
            <div id="shotbtn" class="btn btn-warning">Add Shots</div>
            <hr>

                @foreach ($shot->get_shots as $shotList)
                    <div class="row">
                     <div class="col-md-2"><div class="btn btn-link remove">Remove</div></div>
                        <div class="col-md-6">
                     {{Form::text('shots[]',$shotList->shot, array('class'=> 'form-control'))}}
                        </div>
                    </div>
                @endforeach

            <div id="wrapper"></div>


            {{Form::label('tips','Tips:')}}
            {{Form::textarea('tips', null, array('class'=> 'form-control'))}}
            {{Form::label('duration','How many minutes?')}}
            {{Form::text('duration', $shot->time, array('class'=> 'form-control'))}}




            {{Form::submit('Add', array('class'=> 'btn btn-success btn-lg btn-block'))}}
            {!! Form::close() !!}
        </div>





    </div>


    </div>

@stop
@section('java')
    <script>


        $(document).on('click','.remove',function(){

            $(this).closest('.row').remove();
        });

        $('#shotbtn').on('click', function(){



//            $('#tblShots').append('<tr><td "><div class="btn btn-link btn-sm">Remove</div></td><td class="">'+$shot+'</td></tr>');


//            $('#wrapper').append('<div><input class="form-control" name="shots[]"</div>');
            $('#wrapper').append(' <div class="row"><div class="col-md-2"><div class="btn btn-link remove">Remove</div></div><div class="col-md-6">{{Form::text("shots[]",Null, array("class"=> "form-control"))}}</div></div>')



        });
        $('.deleteShot').on('click', function(){

            alert($this.closest(td.eq(0).text));
        })

    </script>
@stop
