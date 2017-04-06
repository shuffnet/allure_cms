<h4>Timelines for this job</h4>

<div id="workingtimeline">

    @foreach($job->timeline as $timeline)
        <?php
        $timelineDate = new Carbon($timeline->jobDate);
        $timelineDate = $timelineDate->format('l F jS \\  Y');
        ?>


        <div class="row">
            <div class="col col-md-1 text-left">
                {!! Form::open(['route' => ['timeline.destroy', $timeline->id], 'method'=>'DELETE']) !!}

                {{Form::submit('Delete', array('class'=> 'btn btn-link btn-sm'))}}
                {!! Form::close() !!}

            </div>
            <div class="col col-md-4">
                <h3>{{$timeline->name }}<div class="btn btn-link btn-lg">{{$timelineDate}}</div></h3>
            </div>


        </div>
    @endforeach

    <h4>Create another Timeline: <div id="btnCreateTimeline" class="btn btn-link">Create</div></h4>



</div>

<div class="container">
    <!-- Modal -->
    <div class="modal fade" id="createTimelineModal" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Create New Time Line</h4>

                </div>
                <div class="modal-body">
                    {{$job->id}}
                    <div class="" id="newTimeline">
                        <div class="input-group">
                            <label for="name">Name:</label>
                            <input class="form-control" id="name" name="name" type="text">
                        </div>
                        <div class="input-group">
                            <label for="howMuchTime">Number of hours purchased:</label>
                            <input class="form-control" id="howMuchTime" name="howMuchTime" type="text">
                        </div>
                        <div class="input-group" >
                            <label for='ceremony-date'> Ceremony Date:</label>
                            <input class="form-control" value="2017-03-12" type='date' name='ceremony-date' id='ceremony-date-id'>


                        </div>
                        <div class="input-group" >
                            <label for='ceremony-time'> Ceremony Start Time:</label>
                            <input class="form-control" value="17:30" type='time' name='ceremony-time' id='ceremony-time-id'>


                        </div>
                        <div class="input-group">


                            <label for='ceremony-end-time'>Ceremony End Time:</label>
                            <input class="form-control"value="18:00"type='time' name='ceremony-end-time' id='ceremony-end-id'>



                        </div>



                    </div>

                </div>
                <div class="modal-footer">
                    <div id="btnCustomAdd" class="btn btn-default ">Custom</div>
                    <div id="btnStandard6" class="btn btn-default ">Standard Six</div>
                    <div id="btnStandard8" class="btn btn-default ">Standard Eight</div>


                </div>
            </div>

        </div>
    </div>


</div>

