


<div class="row">

    <div class="col col-md-6 col-md-offset-4">
        @if( ! empty($timelines))
        <h4>Timelines for this job</h4>
        <table class="table">

                @foreach($timelines as $timeline)
                  <?php
                    $time = new Carbon($timeline->jobDate);
                    ?>

                    <td><td>{{$timeline->id}}</td><td>{{$time->format('l F jS \\  Y')}}</td><td class="btn btn-link">Open</td></tr>

                @endforeach
        </table>
            @else
                    <h4>No Time lines for this job: <div id="btnCreateTimeline" class="btn btn-link">Create</div></h4>


            @endif
    </div>
</div>
    <div class="row">

            <div id="timelineshots" class="hidden col col-md-4 col-md-offset-2">

                <h3>Shots</h3>
                <div class="btn btn-default" id="custModalBtn">Add Custom Shot</div>

                <table class="tableDisplay table" id="shotListTable">
                    <tbody>

                    @php ($i = 1)

                    @foreach($shots as $shot)
                        <tr class=""><td><i class="btn glyphicon glyphicon-plus  active" data-toggle="collapse" id="row{{$i}}" data-target=".row{{$i}}"></i></td><td class="hidden">{{$shot->time}}</td><td>{{$shot->name}}</td><td class="hidden">{{ $shot->shots }}</td><td class="hidden">{{$shot->tips}}</td><td><div class="btn btn-default addPre">Pre</div></td><td><div class="btn btn-default btn-sm addPost">Post</div></td></tr>
                        <tr class=" info collapse row{{$i}}"><td colspan="4"  class=""><ul class="">{!! $shot->shots !!}  </ul></td></tr>
                        <tr class="info collapse row{{$i}}"><td colspan="4" class=""><p>{{$shot->tips}}</p></td></tr>
                    @php ($i = $i + 1)
                    @endforeach

                    </tbody>
                </table>



            </div>

            <div id="workingtimeline" class="col col-md-6  ">
                <h4>Working Time Line</h4>
                <table class="tableDisplay table" id="timeline">



                </table>
                <div id="purchased"></div>
                <div id="totaltime"></div>
            </div>

    </div>

        </body>
        </html>
    @include('partials.modals._editTimeline')
    @include('partials.modals._customTimeline')





