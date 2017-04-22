@extends('main')

@section('content')

    <div class="row">
        <div class="col col-md-4">
        @foreach($shots->sortBy('name') as $shot)
            <div class="row">
               <a class='col-md-1'href="{{ route('timelinegroupshot.addshot', ['groupid' => $group->id, 'shotid' => $shot->id])}}">Add</a>

                <div class="col col-md-6"><h4>{{$shot->name}}</h4></div>


            </div>

            @endforeach





        </div>

        <div id="" class="col col-md-4 ">

            <h3>Create Group Items</h3>
            <hr>
            {!! Form::model($group, ['route'=>['timelinegroup.update', $group->id], 'method'=> 'PUT']) !!}


            {{Form::label('group','Group Name:')}}
            {{Form::text('group', null, array('class'=> 'form-control'))}}



            {{Form::submit('Update', array('class'=> 'btn btn-success btn-lg btn-block'))}}
            {!! Form::close() !!}

            <div class="row">
                <table class="table">
                    @foreach($group->getgroupshots->sortBy('pivot.id') as $shot)
                        <tr>
                            <td>
                                {!! Form::open(['route' => ['timelinegroupshot.destroy', $shot->pivot->id], 'method'=>'DELETE']) !!}

                                {{Form::submit('Delete', array('class'=> 'btn btn-link btn-md'))}}
                                {!! Form::close() !!}</td>
                            <td>{{ $shot->pivot->id }}</td>
                            <td>{{$shot->name}}</td>
                        </tr>
                    @endforeach


                </table>

            </div>
        </div>





    </div>



    </div>

@stop
@section('java')

@stop
