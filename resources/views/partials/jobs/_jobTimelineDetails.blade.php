</div>






<div class="row">

    <div id="timelineshots" class="hidden col col-md-4 col-md-offset-1">

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

    <div id="" class="col col-md-6  ">





        <div id="workingtimeline">
            <table class="tableDisplay table" id="timeline">



            </table>
        </div>
        <div id="btnSaveTimeline" class="btn btn-success hidden">Save Me</div>
        <div id="timepurchased"></div>
        <div id="purchased"></div>
        <div id="totaltime"></div>

    </div>
    <div id="btnSaveTimeline" class="btn btn-success hidden">Save</div>
    <div id="btnSaveTimeline2" class="btn btn-success ">Save2</div>




</div>

</body>
</html>
@include('partials.modals._editTimeline')
@include('partials.modals._customTimeline')
