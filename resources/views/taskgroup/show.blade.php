@extends('main')
<style>

</style>
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
                @foreach($tasks as $task)
                    <tr>

                        <td>
                            {!!Form::open(['route' =>['taskgroup.addtask']]) !!}
                            {{Form::text('taskgroup_id',$group->id, ['class'=>'hidden'])}}
                            {{Form::text('taskitems_id', $task->id, ['class'=>'hidden'])}}
                            {{Form::submit('Add', array('class'=> 'btn btn-link btn-md'))}}
                            {!!Form::close() !!}

                        </td>
                        <td>{{$task->task}}</td>
                    </tr>

                @endforeach

                </tbody>



            </table>



        </div>

        <div class="col col-md-6 font">

            <h3 >Group</h3>
            <hr>
            <dl class="dl-horizontal ">
                <dt><h3>Group:</h3></dt>
                <dd class=""><h3>{{$group->group}}</h3></dd>
            </dl>
            <br>

            <table class="table">


            @foreach($group->get_task as $item)

                <tr>
                    <td>

                        {!! Form::open(['route' => ['taskgroup.destroytask', $item->pivot->id], 'method'=>'DELETE']) !!}

                        {{Form::submit('Delete', array('class'=> 'btn btn-link btn-md'))}}
                        {!! Form::close() !!}


                    </td>


                    <td>{{$item->task}}</td>


                    <td>{{$item->dueDateRulesTime}}@if($item->dueDateRulesTime ==1) day @endif @if($item->dueDateRulesTime > 1)days @endif</td>
                        @if($item->dueDateRules_id == 1)
                            <td>Before Session</td>
                        @endif
                        @if($item->dueDateRules_id == 2)
                            <td> After Session  </td>
                        @endif
                        @if($item->dueDateRules_id == 3)
                            <td> After Booked  </td>
                    @endif
                </tr>



            @endforeach
            </table>
        </div>








    </div>


    </div>

@stop
