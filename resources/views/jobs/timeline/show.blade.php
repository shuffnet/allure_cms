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
    {{$timeline->id}}

    <div class="row">


        <div id="" class="col col-md-6  ">


            <table data-toggle="table"  data-sort-name="time" data-sort-order="asc">

                <thead>
                <tr>
                    <th>id</th>
                    <th>duration</th>
                    <th>Time</th>
                    <th class="hidden" data-field="time" data-sortable="true">time</th>
                    <th>shot</th>
                </tr>
                </thead>

                <tbody>

                @foreach($timeline->timeline_shots as $shot)

                    <tr>
                        <td> {{$shot->id}}</td>

                        <td>{{$shot->duration}}</td>
                        <td>{{$shot->shortTime}}</td>
                        <td class="hidden"  >{{$shot->time}}</td>
                        <td>{{$shot->shot}}</td>


                    </tr>
                @endforeach
            </tbody>
            </table>
        </div>


        </div>










    @include('../partials.jobs._timeline')
@endsection
@section('java')


    @include('../../partials.js._timeline')


    <script>

        $( document ).ready(function() {

//            $('#workingtimeline').removeClass('hidden');
//
//            ceremonyDate = $('#ceremony-date-id').val();
//            ceremonyStartTime = $('#ceremony-time-id').val();
//            ceremonyEndTime = $('#ceremony-end-id').val();
//            howMuchTime = $('#howMuchTime').val();
//            $('#timepurchased').text(howMuchTime);
//            convertToMinutes = howMuchTime * 60;
//
//            ceremonyDateTime = ceremonyDate + ',' + ceremonyStartTime;
//            ceremonyEndDateTime = ceremonyDate + ','+ ceremonyEndTime;
//            ceremonyStartDateTime = new Date(ceremonyDateTime);
//            ceremonyEndDateTime = new Date(ceremonyEndDateTime);
//            ceremonyStartShort = ceremonyStartDateTime.toLocaleTimeString(navigator.language, {hour: '2-digit', minute:'2-digit'});
//            ceremonyEndShort = ceremonyEndDateTime.toLocaleTimeString(navigator.language, {hour: '2-digit', minute:'2-digit'});
//
//
//            var startTime = new Date(ceremonyStartDateTime);
//            var endTime = new Date(ceremonyEndDateTime);
//            var difference = endTime.getTime() - startTime.getTime(); // This will give difference in milliseconds
//            var min = Math.round(difference / 60000);
//
//
//
//
//            setup = subtractMinutes(ceremonyStartDateTime,15);
//            setupHour = setup.getHours();
//            setupMin = setup.getMinutes();
//            setupTotal = setupHour +":"+ setupMin;
//            setupShort = setup.toLocaleTimeString(navigator.language, {hour: '2-digit', minute:'2-digit'});
//
//            pbreak = subtractMinutes(ceremonyStartDateTime,30);
//            pbreakHour = pbreak.getHours();
//            pbreakMin = pbreak.getMinutes();
//            pbreakTotal = pbreakHour +":"+ pbreakMin;
//            pbreakShort = pbreak.toLocaleTimeString(navigator.language, {hour: '2-digit', minute:'2-digit'});
//
//            groomImmediateFamily = 5;
//            groomGroomsmen = 15;
//
//            groomDetails = 5;
//
//            brideImmediateFamily = 5;
//            brideBridesmaids = 15;
//            brideGettingReady = 30;
//            brideDetails = 15;
//            familyFormals = 15;
//            bridalParty = 15;
//            brideGroom = 15;
//            setupReception = 10;
//            entrance = 150;
//            reception = 0;
//
//
//
//
//
//
//            $('#timeline').append("<tr><td class='edit btn-link' >Edit</td><td class='remove  btn-link'>Remove</td><td class='addTime'>15</td><td>"+pbreakShort+"</td><td class='amount'>"+pbreakTotal+"</td><td>Photographers Break</td></tr>");
//
//            $('#timeline').append("<tr><td class='edit btn-link' >Edit</td><td class='remove  btn-link'>Remove</td><td class='addTime'>15</td><td>"+setupShort+"</td><td class='amount'>"+setupTotal+"</td><td>Photographers Setup For Ceremony</td></tr>");
//
//            $('#timeline').append("<tr style='color: #fff; background: lightblue;'><td class='edit btn-link' >Edit</td><td class='remove  btn-link'>Remove</td><td class='addTime'>"+min+"</td><td>"+ceremonyStartShort+"</td><td class=''>"+ceremonyStartTime+"</td><td> Ceremony Start Time</td></tr>");
//
//            $('#timeline').append("<tr><td class='edit btn-link' >Edit</td><td class='remove  btn-link'>Remove</td><td class='addTime'>5</td><td>"+ceremonyEndShort+"</td><td class='amount'>"+ceremonyEndTime+"</td><td> Ceremony End Time</td></tr>");
//
//            //            this sets groom getting ready time
//
//
//            $minutes = groomImmediateFamily;
//            $shot = "Groom with immediate family";
//            $shots = "<li>Groom with mom</li><li>Groom with dad</li><li>Groom with mom & dad</li>";
//            $tips = "Family members and siblings families should be ready";
//            setDate = $('#ceremony-date-id').val();
//            setStartTime = $('#timeline tr:first td:nth-child(4)').text();
//            setShotTime = $('#timeline tr:first td:nth-child(2)').text();
//            setDateTime = setDate + ',' + setStartTime;
//            setDateTime = new Date(setDateTime);
//            setNewTime = subtractMinutes(setDateTime, $minutes);
//
//            shortHour = setNewTime.getHours();
//            shortMin = setNewTime.getMinutes();
//            //            24hr Time
//            longTime = shortHour + ":" + shortMin;
//            //            12hr time
//            shortTime = setNewTime.toLocaleTimeString(navigator.language, {hour: '2-digit', minute: '2-digit'});
//
//            $('#timeline').prepend("<tr><td class='edit btn-link' >Edit</td><td class='remove btn btn-link'>Remove</td><td class='addTime'>"+$minutes+"</td><td>"+shortTime+"</td><td class=''>"+longTime+"</td><td>"+$shot+"</td><td id='detail' class=' '>"+$shots+"</td><td class='hidden'>"+$tips+"</td></tr>");
//
//
//            $minutes = groomGroomsmen;
//            $shot = "Groom alone and with groomsmen";
//            $shots = "<li>Groom alone</li><li>Groom with each groomsmen</li><li>Groom with all groomsmen</li>";
//            $tips = "Groomsmen need to be ready and on time. Bring sunglasses";
//            setDate = $('#ceremony-date-id').val();
//            setStartTime = $('#timeline tr:first td:nth-child(4)').text();
//            setShotTime = $('#timeline tr:first td:nth-child(2)').text();
//            setDateTime = setDate + ',' + setStartTime;
//            setDateTime = new Date(setDateTime);
//            setNewTime = subtractMinutes(setDateTime, $minutes);
//
//            shortHour = setNewTime.getHours();
//            shortMin = setNewTime.getMinutes();
//            //            24hr Time
//            longTime = shortHour + ":" + shortMin;
//            //            12hr time
//            shortTime = setNewTime.toLocaleTimeString(navigator.language, {hour: '2-digit', minute: '2-digit'});
//
//            $('#timeline').prepend("<tr><td class='edit btn-link' >Edit</td><td class='remove btn btn-link'>Remove</td><td class='addTime'>"+$minutes+"</td><td>"+shortTime+"</td><td class=''>"+longTime+"</td><td>"+$shot+"</td><td class=''>"+$shots+"</td><td class='hidden'>"+$tips+"</td></tr>");
//
//
//            $minutes = groomDetails;
//            $shot = "Groom details";
//            $shots = "<li>Groom details</li>";
//            $tips = "Groom details, cuff links, etc";
//            setDate = $('#ceremony-date-id').val();
//            setStartTime = $('#timeline tr:first td:nth-child(4)').text();
//            setShotTime = $('#timeline tr:first td:nth-child(2)').text();
//            setDateTime = setDate + ',' + setStartTime;
//            setDateTime = new Date(setDateTime);
//            setNewTime = subtractMinutes(setDateTime, $minutes);
//
//            shortHour = setNewTime.getHours();
//            shortMin = setNewTime.getMinutes();
//            //            24hr Time
//            longTime = shortHour + ":" + shortMin;
//            //            12hr time
//            shortTime = setNewTime.toLocaleTimeString(navigator.language, {hour: '2-digit', minute: '2-digit'});
//
//            $('#timeline').prepend("<tr><td class='edit btn-link' >Edit</td><td class='remove btn btn-link'>Remove</td><td class='addTime'>"+$minutes+"</td><td>"+shortTime+"</td><td class=''>"+longTime+"</td><td>"+$shot+"</td><td class=''>"+$shots+"</td><td class='hidden'>"+$tips+"</td></tr>");
//
//            $minutes = brideImmediateFamily;
//            $shot = "Bride with immediate family";
//            $shots = "<li>Bride with mom</li>";
//            $tips = "tips for bride and immediate family";
//            setDate = $('#ceremony-date-id').val();
//            setStartTime = $('#timeline tr:first td:nth-child(4)').text();
//            setShotTime = $('#timeline tr:first td:nth-child(2)').text();
//            setDateTime = setDate + ',' + setStartTime;
//            setDateTime = new Date(setDateTime);
//            setNewTime = subtractMinutes(setDateTime, $minutes);
//
//            shortHour = setNewTime.getHours();
//            shortMin = setNewTime.getMinutes();
//            //            24hr Time
//            longTime = shortHour + ":" + shortMin;
//            //            12hr time
//            shortTime = setNewTime.toLocaleTimeString(navigator.language, {hour: '2-digit', minute: '2-digit'});
//
//            $('#timeline').prepend("<tr><td class='edit btn-link' >Edit</td><td class='remove btn btn-link'>Remove</td><td class='addTime'>"+$minutes+"</td><td>"+shortTime+"</td><td class=''>"+longTime+"</td><td>"+$shot+"</td><td class=''>"+$shots+"</td><td class='hidden'>"+$tips+"</td></tr>");
//
//
//            // *****************Bride with bridesmaids****************************
//            $minutes = brideBridesmaids;
//            $shot = "Bride alone and with bridesmaids";
//            $shots = "<li>Bride alone</li>";
//            $tips = "tips for bride and bridesmaids";
//            setDate = $('#ceremony-date-id').val();
//            setStartTime = $('#timeline tr:first td:nth-child(4)').text();
//            setShotTime = $('#timeline tr:first td:nth-child(2)').text();
//            setDateTime = setDate + ',' + setStartTime;
//            setDateTime = new Date(setDateTime);
//            setNewTime = subtractMinutes(setDateTime, $minutes);
//
//            shortHour = setNewTime.getHours();
//            shortMin = setNewTime.getMinutes();
//            //            24hr Time
//            longTime = shortHour + ":" + shortMin;
//            //            12hr time
//            shortTime = setNewTime.toLocaleTimeString(navigator.language, {hour: '2-digit', minute: '2-digit'});
//
//            $('#timeline').prepend("<tr><td class='edit btn-link' >Edit</td><td class='remove btn btn-link'>Remove</td><td class='addTime'>"+$minutes+"</td><td>"+shortTime+"</td><td class=''>"+longTime+"</td><td>"+$shot+"</td><td class=''>"+$shots+"</td><td class='hidden'>"+$tips+"</td></tr>");
//
//            //******************Bride getting ready*********************
//            $minutes = brideGettingReady;
//            $shot = "Bride Getting Ready";
//            $shots = "<li>Bride getting in dress</li>";
//            $tips = "tips for bride getting ready";
//            setDate = $('#ceremony-date-id').val();
//            setStartTime = $('#timeline tr:first td:nth-child(4)').text();
//            setShotTime = $('#timeline tr:first td:nth-child(2)').text();
//            setDateTime = setDate + ',' + setStartTime;
//            setDateTime = new Date(setDateTime);
//            setNewTime = subtractMinutes(setDateTime, $minutes);
//
//            shortHour = setNewTime.getHours();
//            shortMin = setNewTime.getMinutes();
//            //            24hr Time
//            longTime = shortHour + ":" + shortMin;
//            //            12hr time
//            shortTime = setNewTime.toLocaleTimeString(navigator.language, {hour: '2-digit', minute: '2-digit'});
//
//            $('#timeline').prepend("<tr><td class='edit btn-link' >Edit</td><td class='remove btn btn-link'>Remove</td><td class='addTime'>"+$minutes+"</td><td>"+shortTime+"</td><td class=''>"+longTime+"</td><td>"+$shot+"</td><td class=''>"+$shots+"</td><td class='hidden'>"+$tips+"</td></tr>");
//
//
//
//
//
//            //*******************Bride Details***************************
//
//
//            $minutes = brideDetails;
//            $shot = "Bride details";
//            $shots = "<li>Bride with her details</li>";
//            $tips = "tips for bride and her details";
//            setDate = $('#ceremony-date-id').val();
//            setStartTime = $('#timeline tr:first td:nth-child(4)').text();
//            setShotTime = $('#timeline tr:first td:nth-child(2)').text();
//            setDateTime = setDate + ',' + setStartTime;
//            setDateTime = new Date(setDateTime);
//            setNewTime = subtractMinutes(setDateTime, $minutes);
//
//            shortHour = setNewTime.getHours();
//            shortMin = setNewTime.getMinutes();
//            //            24hr Time
//            longTime = shortHour + ":" + shortMin;
//            //            12hr time
//            shortTime = setNewTime.toLocaleTimeString(navigator.language, {hour: '2-digit', minute: '2-digit'});
//
//            $('#timeline').prepend("<tr><td class='edit btn-link' >Edit</td><td class='remove btn btn-link'>Remove</td><td class='addTime'>"+$minutes+"</td><td>"+shortTime+"</td><td class=''>"+longTime+"</td><td>"+$shot+"</td><td class=''>"+$shots+"</td><td class='hidden'>"+$tips+"</td></tr>");
//
//            $('#timeline').prepend("<tr style='color: black; background: lightgreen;'><td class='edit btn-link' >Edit</td><td class='remove btn btn-link'>Remove</td><td class='addTime'>"+0+"</td><td>"+shortTime+"</td><td class=''>"+longTime+"</td><td>Photographer Arrive</td><td class='hidden'></td><td class='hidden'></td></tr>");
//
//
//
//            //**********Post wedding******************
//
//            $minutes = familyFormals;
//            $shot =  "Family Formals";
//            $shots = "Shots of Family";
//            $tips = "Tips for family shots";
//
//            setDate = $('#ceremony-date-id').val();
//            setStartTime = $('#timeline tr:last td:nth-child(5)').text();
//            setShotTime = $('#timeline tr:last td:nth-child(3)').text();
//
//            setDateTime = setDate + ',' + setStartTime;
//            setDateTime = new Date(setDateTime);
//            setNewTime = addMinutes(setDateTime, setShotTime);
//
//            shortHour = setNewTime.getHours();
//            shortMin = setNewTime.getMinutes();
//            longTime = shortHour +":"+ shortMin;
//            shortTime = setNewTime.toLocaleTimeString(navigator.language, {hour: '2-digit', minute:'2-digit'});
//
//            $('#timeline').append("<tr><td class='edit btn-link' >Edit</td><td class='remove btn btn-link'>Remove</td><td class='addTime'>"+$minutes+"</td><td>"+shortTime+"</td><td class=''>"+longTime+"</td><td>"+$shot+"</td><td class=''>"+$shots+"</td><td class='hidden'>"+$tips+"</td></tr>");
//
//
//            //**************Bridal Party**************************
//
//            $minutes = bridalParty;
//            $shot =  "Bridal Party";
//            $shots = "Shots with bridal party";
//            $tips = "Tips for shots with bridal party";
//
//            setDate = $('#ceremony-date-id').val();
//            setStartTime = $('#timeline tr:last td:nth-child(5)').text();
//            setShotTime = $('#timeline tr:last td:nth-child(3)').text();
//
//            setDateTime = setDate + ',' + setStartTime;
//            setDateTime = new Date(setDateTime);
//            setNewTime = addMinutes(setDateTime, setShotTime);
//
//            shortHour = setNewTime.getHours();
//            shortMin = setNewTime.getMinutes();
//            longTime = shortHour +":"+ shortMin;
//            shortTime = setNewTime.toLocaleTimeString(navigator.language, {hour: '2-digit', minute:'2-digit'});
//
//            $('#timeline').append("<tr><td class='edit btn-link' >Edit</td><td class='remove btn btn-link'>Remove</td><td class='addTime'>"+$minutes+"</td><td>"+shortTime+"</td><td class=''>"+longTime+"</td><td>"+$shot+"</td><td class=''>"+$shots+"</td><td class='hidden'>"+$tips+"</td></tr>");
//
//            //**************Bride and Groom**************************
//
//            $minutes = brideGroom;
//            $shot =  "Bride and Groom";
//            $shots = "Bride and groom shots";
//            $tips = "Tips for shots with bride and groom";
//
//            setDate = $('#ceremony-date-id').val();
//            setStartTime = $('#timeline tr:last td:nth-child(5)').text();
//            setShotTime = $('#timeline tr:last td:nth-child(3)').text();
//
//            setDateTime = setDate + ',' + setStartTime;
//            setDateTime = new Date(setDateTime);
//            setNewTime = addMinutes(setDateTime, setShotTime);
//
//            shortHour = setNewTime.getHours();
//            shortMin = setNewTime.getMinutes();
//            longTime = shortHour +":"+ shortMin;
//            shortTime = setNewTime.toLocaleTimeString(navigator.language, {hour: '2-digit', minute:'2-digit'});
//
//            $('#timeline').append("<tr><td class='edit btn-link' >Edit</td><td class='remove btn btn-link'>Remove</td><td class='addTime'>"+$minutes+"</td><td>"+shortTime+"</td><td class=''>"+longTime+"</td><td>"+$shot+"</td><td class=''>"+$shots+"</td><td class='hidden'>"+$tips+"</td></tr>");
//
//            //**************Setup for reception**************************
//
//            $minutes = setupReception;
//            $shot =  "Pictures complete";
//            $shots = "Setup for reception";
//            $tips = "Tips for setup for reception";
//
//            setDate = $('#ceremony-date-id').val();
//            setStartTime = $('#timeline tr:last td:nth-child(5)').text();
//            setShotTime = $('#timeline tr:last td:nth-child(3)').text();
//
//            setDateTime = setDate + ',' + setStartTime;
//            setDateTime = new Date(setDateTime);
//            setNewTime = addMinutes(setDateTime, setShotTime);
//
//            shortHour = setNewTime.getHours();
//            shortMin = setNewTime.getMinutes();
//            longTime = shortHour +":"+ shortMin;
//            shortTime = setNewTime.toLocaleTimeString(navigator.language, {hour: '2-digit', minute:'2-digit'});
//
//            $('#timeline').append("<tr><td class='edit btn-link' >Edit</td><td class='remove btn btn-link'>Remove</td><td class='addTime'>"+$minutes+"</td><td>"+shortTime+"</td><td class=''>"+longTime+"</td><td>"+$shot+"</td><td class=''>"+$shots+"</td><td class='hidden'>"+$tips+"</td></tr>");
//
//
//
//
//
//            //**************Reception**************************
//
//            $minutes = entrance;
//            $shot =  "Reception Entrance";
//            $shots = "Reception pics";
//            $tips = "Tips for shots at reception";
//
//            setDate = $('#ceremony-date-id').val();
//            setStartTime = $('#timeline tr:last td:nth-child(5)').text();
//            setShotTime = $('#timeline tr:last td:nth-child(3)').text();
//
//            setDateTime = setDate + ',' + setStartTime;
//            setDateTime = new Date(setDateTime);
//            setNewTime = addMinutes(setDateTime, setShotTime);
//
//            shortHour = setNewTime.getHours();
//            shortMin = setNewTime.getMinutes();
//            longTime = shortHour +":"+ shortMin;
//            shortTime = setNewTime.toLocaleTimeString(navigator.language, {hour: '2-digit', minute:'2-digit'});
//
//            $('#timeline').append("<tr><td class='edit btn-link' >Edit</td><td class='remove btn btn-link'>Remove</td><td class='addTime'>"+$minutes+"</td><td>"+shortTime+"</td><td class=''>"+longTime+"</td><td>"+$shot+"</td><td class=''>"+$shots+"</td><td class='hidden'>"+$tips+"</td></tr>");
//
//            //**************Reception**************************
//
//            $minutes = reception;
//            $shot =  "Reception end";
//            $shots = "Shots at reception";
//            $tips = "Tips for shots at reception";
//
//            setDate = $('#ceremony-date-id').val();
//            setStartTime = $('#timeline tr:last td:nth-child(5)').text();
//            setShotTime = $('#timeline tr:last td:nth-child(3)').text();
//
//            setDateTime = setDate + ',' + setStartTime;
//            setDateTime = new Date(setDateTime);
//            setNewTime = addMinutes(setDateTime, setShotTime);
//
//            shortHour = setNewTime.getHours();
//            shortMin = setNewTime.getMinutes();
//            longTime = shortHour +":"+ shortMin;
//            shortTime = setNewTime.toLocaleTimeString(navigator.language, {hour: '2-digit', minute:'2-digit'});
//
//            $('#timeline').append("<tr><td class='edit btn-link' >Edit</td><td class='remove btn btn-link'>Remove</td><td class='addTime'>"+$minutes+"</td><td>"+shortTime+"</td><td class=''>"+longTime+"</td><td>"+$shot+"</td><td class=''>"+$shots+"</td><td class='hidden'>"+$tips+"</td></tr>");
//
//            //**************Photographers leave**************************
//
//            $minutes = reception;
//            $shot =  "Photographers Leave";
//            $shots = "";
//            $tips = "";
//
//            setDate = $('#ceremony-date-id').val();
//            setStartTime = $('#timeline tr:last td:nth-child(5)').text();
//            setShotTime = $('#timeline tr:last td:nth-child(3)').text();
//
//            setDateTime = setDate + ',' + setStartTime;
//            setDateTime = new Date(setDateTime);
//            setNewTime = addMinutes(setDateTime, setShotTime);
//
//            shortHour = setNewTime.getHours();
//            shortMin = setNewTime.getMinutes();
//            longTime = shortHour +":"+ shortMin;
//            shortTime = setNewTime.toLocaleTimeString(navigator.language, {hour: '2-digit', minute:'2-digit'});
//
//            $('#timeline').append("<tr style='color: black; background: red;'><td class='edit btn-link' >Edit</td><td class='remove  btn-link'>Remove</td><td class='addTime'>"+$minutes+"</td><td>"+shortTime+"</td><td class=''>"+longTime+"</td><td>"+$shot+"</td><td class='hidden'>"+$shots+"</td><td class='hidden'>"+$tips+"</td></tr>");
//
//
//
//            var minutes = $('tr:last td:first').text();
//            var time = $('tr:last td:nth-child(3)').text();
//
//
//            $('#createTimelineModal').modal('hide');
//            $('#timelineshots').removeClass('hidden');
//            $('#timelinesection').removeClass('hidden');
//
//            calculateMin();
//            $('#purchased').html("Purchased "+convertToMinutes);
//
//
//            $('#btnSaveTimeline').removeClass('hidden');



            {{--$('#btnSaveTimeline2').on('click', function () {--}}


                {{--TableData = $.toJSON(storeTblValues());--}}
                {{--var $job = '{{$job->id}}';--}}
                {{--var $timeline = {{$timeline->id}};--}}

                {{--$.ajax({--}}
                    {{--url: '/jobtimeline',--}}
                    {{--type: 'POST',--}}
                    {{--data:{--}}
                        {{--'data':TableData,--}}
                        {{--'jobId':$job,--}}
                        {{--'timeline_id':$timeline,--}}

                    {{--},--}}
                    {{--success: function(data){--}}
                        {{--// return value stored in msg variable--}}
                        {{--window.location.reload();--}}



                    {{--}--}}
                {{--});--}}


            {{--});--}}


//            function storeTblValues()
//
//            {
//                var TableData = new Array();
//
//                $('#timeline tr').each(function(row, tr){
//                    TableData[row]={
//                        "duration" : $(tr).find('td:eq(2)').text()
//                        , "time" :$(tr).find('td:eq(4)').text()
//                        , "shot" : $(tr).find('td:eq(5)').text()
////                        , "shots" : $(tr).find('td:eq(6)').html()
//                        , "tips" : $(tr).find('td:eq(7)').text()
//
//                    }
//                });
////                TableData.shift();  // first row will be empty - so remove
////                TableData = $.toJSON(TableData);
//
//                return TableData;
//
//            }





        });


    </script>





@stop

