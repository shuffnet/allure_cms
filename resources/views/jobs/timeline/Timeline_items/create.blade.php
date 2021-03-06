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
    <div class="container">
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
        <div class="col col-md-6"><h3>Timeline: {{$timeline->name}}</h3></div>


    </div>

    <div class="row">
        <div class="row">
            <h3>Timeline Groups</h3>
            @foreach($timelinegroup as $group)
                <div class="row">
                    <a href="{{route('timeline.addTimelinegroup',['timelineId'=>$timeline->id, 'timelinegroupID'=>$group->id, 'jobID'=>$job->id])}}">{{$group->group}}</a>

                </div>

                @endforeach

        </div>
        <div class="row">
            <h3>Shots</h3>
            <div class="btn btn-default" id="custModalBtn">Add Custom Shot</div>
            <a href="{{ route('shotList.index') }}" class="">Shot List</a></td><br/>


        </div>
        <div class="row">
            <div id="btnShotsShow" class="btn btn-warning">Add Shot</div>
        </div>

        <div class="container">
            <!-- Modal -->
            <div class="modal fade" id="shotListModal" role="dialog">
                <div class="modal-dialog">

                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Modal Header</h4>

                        </div>
                        <div class="modal-body">


                            <div id="shotlist" class="col col-md-10">





                                <table class="tableDisplay table table-bordered" id="shotListTable">
                                    <tbody>
                                    <tr>
                                        <th></th>

                                        <th>Shot Name</th>
                                        <th ></th>

                                    </tr>

                                    @php ($i = 1)

                                    @foreach($shots->sortBy('name') as $shot)
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












                        </div>
                        <div class="modal-footer">

                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button id="editModal" type="button" class="btn btn-primary">Save changes</button>
                        </div>
                    </div>

                </div>
            </div>


        </div>





        <div id="" class="col col-md-6  col-md-offset-1">





            <div id="workingtimeline">


            </div>
            <nav class="navbar">

            </nav>
            <nav class="navbar navbar-default">
                <div class="container">
                    <p class="navbar-text">{{$timeline->name}}</p>
                    <p>
                    <div class="btn-group">

                        <a class="btn" href="{{route('timelineshots.clear',['jobID'=>$job->id, 'timelineID'=>$timeline->id])}}">Clear All Shots</a>
                       

                    </div>
                    </p>




                </div>
            </nav>
            <div class="row">
                <table class="table">
                @foreach($timeline->timeline_shots->sortBy('time') as $timeline_shot)


                    <tr>
                        <td><input style="margin-top: 15px;line-height: normal;" type="checkbox"></td>
                        <td><h5><strong>{{$timeline_shot->shortTime}}</strong></h5></td>
                        <td><h5><strong>{{$timeline_shot->shot}}</strong></h5></td>
                    </tr>



                        @foreach($timeline_shot->get_details as $detail)

                            <tr class="hidden"><td></td><td colspan="2">{{$detail->detail}}</td></tr>
                        @endforeach

                     {{--<div class="row">--}}
                         {{--<div class="col col-md-5 col-md-offset-1"><strong>*{{$timeline_shot->tips}}</strong></div>--}}

                     {{--</div>--}}
                        <tr class="hidden"><td colspan="2">{{$timeline_shot->tips}}</td></tr>

                    @endforeach
                </table>
            </div>


            <div id="timepurchased"></div>
            <div id="purchased"></div>
            <div id="totaltime"></div>

        </div>


    </div>


</div>




    @include('../partials.jobs._timeline')
    @include('../partials.modals._add_shot_to_timeline')
    @include('../partials.modals._shotlist')
@endsection
@section('java')


    @include('../../partials.js._timeline')


    <script>
        $('#btnShotsShow').on('click', function(){

            $('#shotListModal').modal("show");
        });

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

