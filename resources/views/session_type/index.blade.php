@extends('main')

@section('content')

    <div class="row">
        <div class="col col-md-4">
            <h3>Shots</h3>

            <table class="table">


                @foreach($types as $type)
                    <tr  class="well">
                        <td style=""><a href="{{ route('shotList.edit', $type->id)}}">Edit</a></td>
                        <td><a href="{{ route('shotDelete.delete', $type->id)}}">Delete</a></td>
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
            {{Form::submit('Save', array('class'=> 'btn btn-success btn-lg btn-block'))}}
            {!! Form::close() !!}
        </div>





    </div>


    </div>

@stop
@section('java')

@stop
