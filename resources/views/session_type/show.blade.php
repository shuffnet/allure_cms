@extends('main')

@section('content')


    <div class="row">
        <div class="col col-md-4">






        </div>

        <div id="" class="col col-md-4 ">

            <h3>Session Type</h3>
            <hr>
            {!! Form::model($type, ['route'=>['session_type.update', $type->id], 'method'=> 'PUT']) !!}
            {!! Form::open(array('route' => 'session_type.store')) !!}

            {{Form::label('type','Session Type:')}}
            {{Form::text('type', null, array('class'=> 'form-control'))}}
                <h5>Task Groups Assigned</h5>
            <div>
            <select name='taskgroup[]' class="bottom-padding task-group form-control" multiple="multiple">

                @foreach($groups as $group)
                    <option value="{{$group->id}}">{{$group->group}}</option>
                @endforeach
            </select>
            </div>
            {{Form::submit('Update', array('class'=> 'top-padding btn btn-success btn-lg btn-block'))}}
            {!! Form::close() !!}
        </div>





    </div>


    </div>

@stop
@section('java')
    <script type="text/javascript">
        $(".task-group").select2();
        $(".task-group").val({!! json_encode( $type->get_taskgroup()->getRelatedIds()) !!}).trigger('change');

    </script>



@stop
