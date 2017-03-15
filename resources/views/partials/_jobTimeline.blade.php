<div class="row">

    <div class="col col-md-6">
        <div>
            <div class="input-group" >

                <input type='date' name='ceremony-date' id='ceremony-date-id'>
                <label for='ceremony-date'> Ceremony Date</label>

            </div>
            <div class="input-group" >

                <input type='time' name='ceremony-time' id='ceremony-time-id'>
                <label for='ceremony-time'> Ceremony Start Time</label>

            </div>
            <div class="input-group">



                <input type='time' name='ceremony-end-time' id='ceremony-end-id'>
                <label for='ceremony-end-time'>Ceremony End Time</label>


            </div>

            <div id="cermonyAdd" class="btn btn-default">Add</div>

        </div>

        <h3>Shots</h3>
        <div class="btn btn-default" id="custModalBtn">Add Custom Shot</div>

        <table class="tableDisplay table" id="shotListTable">
            <tbody>

            @php ($i = 1)

            @foreach($shots as $shot)
                <tr class=""><td><i class="glyphicon glyphicon-plus clickable active" data-toggle="collapse" id="row{{$i}}" data-target=".row{{$i}}"></i></td><td class="hidden">{{$shot->time}}</td><td>{{$shot->name}}</td><td class="hidden">{{ $shot->shots }}</td><td class="hidden">{{$shot->tips}}</td><td><div class="btn btn-default addPre">Pre</div></td><td><div class="btn btn-default addPost">Post</div></td></tr>
                <tr class=" info collapse row{{$i}}"><td colspan="4"  class=""><ul class="">{!! $shot->shots !!}  </ul></td></tr>
                <tr class="info collapse row{{$i}}"><td colspan="4" class=""><p>{{$shot->tips}}</p></td></tr>
            @php ($i = $i + 1)
            @endforeach

            </tbody>
        </table>



    </div>
    <div class="col col-md-6 ">
        <h4>Job Photography timeline</h4>
        <table class="tableDisplay table" id="timeline">


        </table>
    </div>

</div>
        </body>
        </html>
    @include('partials.modals._editTimeline')
    @include('partials.modals._customTimeline')





