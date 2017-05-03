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

        <div class="col col-md-8 col-md-offset-2">

            @if (count($job->sessions) > 0)

                <h4>Create another Session: <a  href="{{route('jobsSessions.create', ['jobID'=>$job->id, 'photogID'=>$lead->id])}}">Create</a></h4>
                <div class="row text-center" style="background-color: lightgray"><h4>Sessions for this job</h4></div>

                <div id="workingtimeline">
                    <table>
                        @foreach($job->sessions as $session)
                            <?php
                            $session_date = new Carbon($session->date);
                            $session_date = $session_date->format('l F jS \\  Y');
                            ?>


                            <tr>
                                <td class="">
                                    {!! Form::open(['route' => ['session.destroy', $session->id], 'method'=>'DELETE']) !!}

                                    {{Form::submit('Delete', array('class'=> 'btn btn-link btn-lg'))}}
                                    {!! Form::close() !!}

                                </td>
                                <td>{{$session->get_type->type}}</td>
                                <td >
                                    <a href="{{route('jobsSessions.show', ['jobID'=>$job->id, 'sessionID'=>$session->id])}}" class="btn btn-link btn-lg"><strong>{{$session->type_id}}</strong>{{" ". $session_date}}</></a>
                                </td>
                                <td>
                                    {{$session->location}}
                                </td>


                            </tr>
                        @endforeach

                    </table>


                </div>
            @else
                {{--<h4>No Time lines for this job: <div id="btnCreateTimeline" class="btn btn-link">Create</div></h4>--}}

                <h4>Create a Session: <a  href="{{route('jobsSessions.create', ['jobID'=>$job->id, 'photogID'=>$lead->id])}}">Create</a></h4>

            @endif







            {{--{!! htmlspecialchars_decode($job->timeline, ENT_QUOTES) !!}--}}
        </div>




    </div>
    @include('../partials.jobs._timeline')
@endsection
@section('java')


    @include('../../partials.js._timeline')








@stop