@extends('main')

@section('content')

    <div class="row">
        <div class="col col-md-4">
            <h3>Task</h3>

            <table class="table">
                <thead>
                <th>Task</th>
                <th></th>
                <th></th>
                </thead>
                <tbody>
                @foreach($task as $item)
                    <tr><td>{!! Form::open(['route' => ['taskitem.destroy', $item->id], 'method'=>'DELETE']) !!}

                            {{Form::submit('Delete', array('class'=> 'btn btn-link btn-md'))}}
                            {!! Form::close() !!}
                        </td>

                        <td>{{$item->task}}</td>
                    </tr>

                @endforeach

                </tbody>



            </table>



        </div>

        <div class="col col-md-4">

            <h3>Create New Task</h3>
            <hr>
            {!! Form::open(array('route' => 'taskitem.store')) !!}
            {!! csrf_field() !!}

            {{Form::text('task', null, array('placeholder'=>'Task Name','class'=> 'form-control'))}}

            {{Form::text('dueDateRulesTime', null, ['placeholder'=>'Number of days','class'=>'form-control'])}}
            <select name="dueDateRules_id" class="form-control">
                <option selected="selected" value="">Select Rules</option>
                <option value="1">Days Before Session</option>
                <option value="2">Days After Session</option>
                <option value="3">Days After Booked</option>

            </select>
            <select name="assigned_to" class="form-control" >
                <option selected="selected" value="">Assigned To</option>
                <option value="1">Photographer</option>
                <option value="2">Customer Service</option>
                <option value="3">Design</option>
                <option value="4">Production</option>


            </select>

            {{Form::submit('Save', array('class'=> 'btn btn-success btn-lg btn-block'))}}
            {!! Form::close() !!}
        </div>





    </div>


    </div>

@stop
