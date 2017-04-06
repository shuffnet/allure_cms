


<div class="row">

    <div class="col col-md-10 col-md-offset-2">
        @if (count($job->timeline) > 0)

            @include('partials/jobs._jobTimelineIndex')

            @else
            <h4>No Time lines for this job: <div id="btnCreateTimeline" class="btn btn-link">Create</div></h4>


        @endif







            {{--{!! htmlspecialchars_decode($job->timeline, ENT_QUOTES) !!}--}}
    </div>


            {{--<div id="btnSaveTimeline" class="btn btn-success">Save</div>--}}
            {{--<div id="btnClearTimeline" class="btn btn-danger">Clear</div>--}}
            {{--<div id="btnOpenTimeline" class="btn btn-warning">Open</div>--}}













