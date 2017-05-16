@extends('main')
<?php
use Carbon\Carbon;


$jobDate = $job->date;
if (isset($jobDate)) {
    $jobDate = new Carbon($job->date);
    $jobDate = $jobDate->format('l F jS \\  Y');

}
else {
    $jobDate = "No Date";
}

?>
@section('content')
    <div class="container-fluid">
        <div class="row">  <!--Top Row Row-->
            <div class="col col-md-8 col-md-offset-2"> <!--Job Name Column-->
                <div class="row ">
                    <div class="col col-md-8">
                        <h3><a href="">{{$job->name." "}}</a>{{$jobDate}}</h3>

                    </div>
                    <div class="col col-md-3">

                        <div class="row">
                            <div class="col col-md-4">
                                <a class="'btn col btn-link  " href="Details"><small>Details</small></a>


                            </div>
                            <div class="col col-md-4">
                                <a class="'btn col btn-link  " href="{{ route('jobs.edit', $job->id) }}"><small>Edit</small></a>


                            </div>

                            <div class="col col-md-4">

                                {!! Form::open(['route' => ['jobs.destroy', $job->id], 'method'=>'DELETE']) !!}

                                {{Form::submit('Delete', array('class'=> 'btn btn-link btn-sm'))}}
                                {!! Form::close() !!}



                            </div>

                        </div>


                    </div>
                </div>
                <div class="row">
                    @if (isset($lead))

                        <div class="col col-md-8">
                            <h4 class=""><small>Photographed by:
                                </small> {{$lead->fname." ".$lead->lname}}</h4>
                        </div>
                        <nav>
                            <button type="button" class="btn btn-warning navbar-btn">Quote</button>

                            <button type="button" class="btn btn-success navbar-btn">Book</button>
                            <button type="button" class="btn btn-default navbar-btn">Make Payment</button>


                        </nav>

                </div>
                @include('partials.jobs._jobNav')

                @else
                    @include('partials.jobs._jobNav')
                    <div class="col col-md-3">
                        <h4 class="text-right"><small>Photographed by:</small></h4>
                    </div>
                    <div class="col col-md-4">
                        <form action="">
                            {{--{{ csrf_field() }}--}}
                            <select name="photog" id="photog" class="form-control">
                                <option value="" disabled selected>Select Photographer</option>
                                @foreach($photogs as $photog)
                                    <option value="{{$photog->id}}">{{$photog->fname." ".$photog->lname}}</option>
                                @endforeach

                            </select>
                            <div class="col col-md-1">
                                <div id="add-existing-contact" class="btn btn-link">Add Photographer</div>
                            </div>
                        </form>

                    </div>




                    {{--This may have to be added back                --}}{{--</nav>--}}


            </div> <!--End Job Name Column-->

            @endif



        </div> <!--End of job name column-->


    </div>  <!--End of Top Row-->

    </div> <!--End of Top column with job and edit-->

    <div class="row">
        <div class="col col-md-2">



        </div>
        <div class="col col-md-6">

            <div class="row">

                <?php
                $sessionDate = new Carbon($session->date);
                $sessionDate = $sessionDate->format('l F jS \\  Y');
                ?>
                    <div class="row " style="background-color: lightgray"><h3 class="col-md-4 col-md-offset-4">Session</h3></div>


                    <dl class="dl-horizontal">
                        <dt>Date:</dt>
                        <dd> {{$sessionDate}}</dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt>Time:</dt>
                        <dd>{{(new Carbon($session->time))->format('g:i a')}}</dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt>Session:</dt>
                        <dd>{{$session->get_type->type}}</dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt>Location:</dt>
                        <dd>{{ ucfirst($session->location)}}</dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt>Photographer:</dt>
                        <dd>{{ ucfirst($session->get_photographer->fname)}}</dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt>Folder Name:</dt>
                        @php
                        $sessiontype = $session->imagepath;
                       $sessiontype = str_replace (" ", "-", $sessiontype);

                        @endphp
                        <dd>  <input id="foo" class="form-control" value="{{$sessiontype}}">


                            <button class="clipboard" data-clipboard-target="#foo">
                                Copy
                            </button></dd>

                    </dl>




            </div>


        </div>

    </div>

    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <div id="btn_newTask" class=" col-md-1 btn btn-default">Add Task</div>

        </div>
    </nav>



    <div class="col col-md-8 col-md-offset-2">
        <div class="row">
            <table class="table">
                @foreach($session->get_task as $task)
                    <?php
                    $dueDate = $task->dueDate;
                    $dueDateCarbon = new Carbon($dueDate);
                    $dueDate =$dueDateCarbon->format('l F jS \\  Y');
                    $now =  Carbon::now();
                    $daysLeft = $dueDateCarbon->diffInDays($now);
                    ?>

                    <tr>
                        <td><div class="btn btn-default btn-xs">Pin</div></td>
                        <td><div class="btn btn-default btn-xs">Complete</div></td>
                        <td>{{$task->status}}</td>
                        <td><a href="">{{$task->task}}</a></td>
                        <td>{{$dueDate}}</td>
                        <td>{{$daysLeft}} Days Left</td>
                        <td>{{$task->get_contact->fname}} {{$task->get_contact->lname}}</td>
                        <td><a href="">Delete</a></td>
                        <td><a href="">Edit</a></td>
                    </tr>

                @endforeach
            </table>


        </div>
    </div>
    @include('jobs.sessions.modal._new_task')

@endsection
@section('java')

    <script>
        $('#btn_newTask').on('click', function(){
                $("#newTaskModal").modal("show");
        });


        new Clipboard('.clipboard');
        clipboard.destroy();










    </script>









@stop