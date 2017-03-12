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
            {{--<lable for="cermony">Ceremony Start Time</lable>--}}
            {{--<input id='ceremonyTime' name="cermony" type="datetime-local">--}}
            <div id="cermonyAdd" class="btn btn-default">Add</div>

        </div>
        <h3>Shots</h3>

        <table id="shotListTable">


            @foreach($shots as $shot)
                <tr><td class="hidden">{{$shot->time}}</td><td>{{$shot->name}}</td><td><div class="btn btn-link addPre">Pre</div></td><td><div class="btn btn-link addPost">Post</div></td>
                    <td class=""><ul class="hidden">{!! $shot->shots !!}</ul></td><td class="hidden">{{$shot->tips}}</td></tr>


            @endforeach
        </table>



    </div>
    <div class="col col-md-6">

        <table id="timeline">



        </table>
    </div>


</div>