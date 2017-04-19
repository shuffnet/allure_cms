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

<div class="container">

    <div class="row">
        <div class="col col-md-5">
            <a id="timelineshots" class=" col col-md-5 col-md-offset-1"></a>

            <h3>Shots</h3>
            <div class="btn btn-default" id="custModalBtn">Add Custom Shot</div>

            <table class="tableDisplay table table-bordered" id="shotListTable">
                <tbody>
                <tr>
                    <th></th>

                    <th>Shot Name</th>
                    <th ></th>

                </tr>

                @php ($i = 1)

                @foreach($shots as $shot)
                    <tr class="">
                        {{--0--}}
                        <td><i class="btn glyphicon glyphicon-plus  active" data-toggle="collapse" id="row{{$i}}" data-target=".row{{$i}}"></i></td>
                        {{--1--}}
                        <td class="hidden">{{$shot->id}}</td>
                        {{--2--}}
                        <td class="hidden">{{$shot->time}}</td>
                        {{--3--}}
                        <td>{{$shot->name}}</td>
                        {{--4--}}
                        <td class="hidden">{{$shot->tips}}</td>

                        <td><a href="{{ route('job_timeline.jobtimelineAddShot',['jobid'=>$job->id, 'timelineid'=>$timeline->id, 'shotid'=>$shot->id])}}" class="">Add</a></td>
                    </tr>
                    <tr class=" info collapse row{{$i}}"><td colspan="4"  class=""><ul class="">@foreach ($shot->get_shots as $shotList)<li>{{$shotList->shot}}</li>@endforeach</ul></td></tr>
                    <tr class="info collapse row{{$i}}"><td colspan="4" class=""><p>{{$shot->tips}}</p></td></tr>
                    @php ($i = $i + 1)
                @endforeach

                </tbody>
            </table>
            <div id="btnCustomAdd" class="btn btn-default">Custom</div>
            <div id="btnStandard6" class="btn btn-default ">Standard Six</div>
            <div id="btnStandard8" class="btn btn-default ">Standard Eight</div>

        </div>


        <div id="" class="col col-md-5 col-md-offset-1 ">





            <div id="workingtimeline">
                <table class="tableDisplay table" id="timeline">



                </table>
            </div>

            <div id="btnSaveTimeline" class="btn btn-success ">Save</div>
            <div id="timepurchased"></div>
            <div id="purchased"></div>
            <div id="totaltime"></div>

        </div>


    </div>


</div>




    @include('../partials.jobs._timeline')
    @include('../partials.modals._add_shot_to_timeline')
@endsection
@section('java')


    @include('../../partials.js._timeline')


    <script>

        $( document ).ready(function() {
            $('#shotListTable .addPrePhoto1').on('click',function(){

                var $row = $(this).closest("tr");       // Finds the closest row <tr>


                $id = $row.find("td:nth-child(2)").text();

                $minutes = $row.find("td:nth-child(3)").text();
                $shot =  $row.find("td:nth-child(4)").text();

                $tips = $row.find("td:nth-child(5)").text();

//                add_item($row);
                $.ajax({
                    url: '/ajaxGetShot/'+$id,
                    type: 'GET',
                    data:{



                    },
                    success: function(data){

//                        window.location.replace('/jobs/timeline/show/'+$job+'/'+$timeline);

                        $('#add_shot_to_timeline_modal').modal('show');
                        console.log(data);
                        $("input[name='shotName']").val(data.name);

                    }
                });


            });

        });
        $('#btnSaveTimeline').on('click', function () {
            alert('im here');

            TableData = $.toJSON(storeTblValues());
            var $job = '{{$job->id}}';
            var $timeline = {{$timeline->id}};

            $.ajax({
                url: '/jobtimeline',
                type: 'POST',
                data:{
                    'data':TableData,
                    'jobId':$job,
                    'timeline_id':$timeline,

                },
                success: function(data){

                    window.location.replace('/jobs/timeline/show/'+$job+'/'+$timeline);



                }
            });


        });


        function storeTblValues()

        {
            var TableData = new Array();

            $('#timeline tr').each(function(row, tr){
                TableData[row]={
                    "duration" : $(tr).find('td:eq(2)').text()
                    ,"shortTime": $(tr).find('td:eq(3)').text()
                    , "time" :$(tr).find('td:eq(4)').text()
                    , "shot" : $(tr).find('td:eq(5)').text()
//                       , "shots" : $(tr).find('td:eq(6)').html()
                    , "tips" : $(tr).find('td:eq(7)').text()

                }
            });
//                TableData.shift();  // first row will be empty - so remove
//                TableData = $.toJSON(TableData);

            return TableData;

        }


    </script>





@stop

