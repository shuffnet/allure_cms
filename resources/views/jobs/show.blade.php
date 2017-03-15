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


                </div>

                @include('partials._jobNav')

                @else
                    @include('partials._jobNav')
                    <div class="col col-md-3">
                        <h4 class="text-right"><small>Photographed by:</small></h4>
                    </div>
                    <div class="col col-md-4">
                        <form action="">
                            {{ csrf_field() }}
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




                    </nav>
            </div> <!--End Job Name Column-->

            @endif



        </div> <!--End of job name column-->


    </div>  <!--End of Top Row-->

    </div> <!--End of Top column with job and edit-->




    {{--Middle Section--}}
    <div class="container-fluid"> <!--Center Content Container-->
        <div class="row-fluid">
            <div class="col col-md-2">

                @foreach($contacts as $contact)
                    <div class="row">

                        {{--column with contacts--}}
                        <div class="col col-md-12">
                            <div class="col col-md-12 ">
                                <dl class=" ">
                                    <dt>{{$contact->role.":"}}</dt>
                                    <dd><small>{{$contact->fname. " ".$contact->lname}}</small></dd>
                                    <dd><small><a href="">{{$contact->email}}</a></small></dd>
                                    <dd><small>{{$contact->phone}}</small></dd>
                                    <div class="row">
                                        <div class="col col-md-1">
                                            <a href=""><small>View</small></a>
                                        </div>
                                        <div class="col col-md-1">
                                            <a href=""><small>Edit</small></a>

                                        </div>

                                        <div class="col col-md-1">

                                            {!! Form::open(['route' => ['job_role.destroy', $contact->id], 'method'=>'DELETE' ]) !!}

                                            {{Form::submit('Remove', array('class'=> 'btn btn-link btn-sm '))}}
                                            {!! Form::close() !!}

                                        </div>

                                    </div>

                                </dl>

                            </div>

                        </div>

                    </div>

                @endforeach
                <a href=" {{ route('add_contacts.createMore', $job->id) }}">Add Contact</a>


            </div>
            <div class="col col-md-10"> <!--Center Content Section-->
                @include('partials/_orderForm')
                @include('partials/_jobOrders')
                @include('partials/_jobTimeline')


            </div> <!--Center Content Section-->
            {{--<div class="col col-md-4 well"> <!--Start of Notes Section-->--}}
                {{--<p>This is where notes will be</p>--}}

            {{--</div> <!--End of Notes Section-->--}}

        </div>
    </div>
@endsection
@section('java')








    <script type="text/javascript">


        $(document).ready(function(){

           $('#add-existing-contact').click(function(){

                var $lead = $("#photog option:selected").val()
                var $role = '1';
                var $job = '{{$job->id}}';
                var $token = "{{csrf_token()}}";

                $.ajax({
                    url: '/job_role',
                    type: 'POST',
                    data: {
                        'contact_id': $lead,
                        'role_id': $role,
                        'job_id': $job,
                        '_token' : $token,


                        success: function(data){
                            window.location.reload();
                        }
                    }
                });
           });



        });





    </script>
    <script>



        $('#cermonyAdd').on('click', function () {
            ceremonyDate = $('#ceremony-date-id').val();
            ceremonyStartTime = $('#ceremony-time-id').val();
           ceremonyEndTime = $('#ceremony-end-id').val();

            ceremonyDateTime = ceremonyDate + ',' + ceremonyStartTime;
            ceremonyEndDateTime = ceremonyDate + ','+ ceremonyEndTime;
            ceremonyStartDateTime = new Date(ceremonyDateTime);
            ceremonyEndDateTime = new Date(ceremonyEndDateTime);
            ceremonyStartShort = ceremonyStartDateTime.toLocaleTimeString(navigator.language, {hour: '2-digit', minute:'2-digit'});
            ceremonyEndShort = ceremonyEndDateTime.toLocaleTimeString(navigator.language, {hour: '2-digit', minute:'2-digit'});


            setup = subtractMinutes(ceremonyStartDateTime,15);
            setupHour = setup.getHours();
            setupMin = setup.getMinutes();
            setupTotal = setupHour +":"+ setupMin;
            setupShort = setup.toLocaleTimeString(navigator.language, {hour: '2-digit', minute:'2-digit'});

            pbreak = subtractMinutes(ceremonyStartDateTime,30);
            pbreakHour = pbreak.getHours();
            pbreakMin = pbreak.getMinutes();
            pbreakTotal = pbreakHour +":"+ pbreakMin;
            pbreakShort = pbreak.toLocaleTimeString(navigator.language, {hour: '2-digit', minute:'2-digit'});


            $('#timeline').append("<tr><td class='edit btn-link' >Edit</td><td class='remove  btn-link'>Remove</td><td class='hidden'>0</td><td>"+pbreakShort+"</td><td class='hidden'>"+pbreakTotal+"</td><td>Photographers Break</td></tr>");

            $('#timeline').append("<tr><td class='edit btn-link' >Edit</td><td class='remove btn btn-link'>Remove</td><td class='hidden'>0</td><td>"+setupShort+"</td><td class='hidden'>"+setupTotal+"</td><td>Photographers Setup For Ceremony</td></tr>");

            $('#timeline').append("<tr><td class='edit btn-link' >Edit</td><td class='remove btn btn-link'>Remove</td><td class='hidden'>0</td><td>"+ceremonyStartShort+"</td><td class='hidden'>"+ceremonyStartTime+"</td><td> Ceremony Start Time</td></tr>");
            $('#timeline').append("<tr><td class='edit btn-link' >Edit</td><td class='remove btn btn-link'>Remove</td><td class='hidden'>0</td><td>"+ceremonyEndShort+"</td><td class='hidden'>"+ceremonyEndTime+"</td><td> Ceremony End Time</td></tr>");



              var minutes = $('tr:last td:first').text();
              var time = $('tr:last td:nth-child(3)').text();
//              alert(minutes+','+time);


        })

        $('#shotListTable .addPost').on('click',function(){
            var $row = $(this).closest("tr");       // Finds the closest row <tr>
            $minutes = $row.find("td:nth-child(2)").text();
            $shot =  $row.find("td:nth-child(3)").text();
            setDate = $('#ceremony-date-id').val();
            setStartTime = $('#timeline tr:last td:nth-child(5)').text();
            setShotTime = $('#timeline tr:last td:nth-child(3)').text();
            $shots = $row.find("td:nth-child(4)").html();
            $tips = $row.find("td:nth-child(5)").text();




            setDateTime = setDate + ',' + setStartTime;
            setDateTime = new Date(setDateTime);
            setNewTime = addMinutes(setDateTime, setShotTime);

           shortHour = setNewTime.getHours();
           shortMin = setNewTime.getMinutes();
           longTime = shortHour +":"+ shortMin;
           shortTime = setNewTime.toLocaleTimeString(navigator.language, {hour: '2-digit', minute:'2-digit'});

            $('#timeline').append("<tr><td class='edit btn-link' >Edit</td><td class='remove btn btn-link'>Remove</td><td class='hidden'>"+$minutes+"</td><td>"+shortTime+"</td><td class='hidden'>"+longTime+"</td><td>"+$shot+"</td><td class='hidden'>"+$shots+"</td><td class='hidden'>"+$tips+"</td></tr>");
            $row.addClass('hidden');
            $row2 = $(this).closest('tr').next('tr');
            $row3 = $row2.next('tr');
            $row2.addClass('hidden');
            $row3.addClass('hidden');

        });


        $('#shotListTable .addPre').on('click',function() {
            var $row = $(this).closest("tr");       // Finds the closest row <tr>
            $minutes = $row.find("td:nth-child(2)").text();
            $shot = $row.find("td:nth-child(3)").text();
            $shots = $row.find("td:nth-child(4)").html();
            $tips = $row.find("td:nth-child(5)").text();
            setDate = $('#ceremony-date-id').val();
            setStartTime = $('#timeline tr:first td:nth-child(5)').text();
            setShotTime = $('#timeline tr:first td:nth-child(3)').text();



            setDateTime = setDate + ',' + setStartTime;
            setDateTime = new Date(setDateTime);
            setNewTime = subtractMinutes(setDateTime, $minutes);

            shortHour = setNewTime.getHours();
            shortMin = setNewTime.getMinutes();
//            24hr Time
            longTime = shortHour + ":" + shortMin;
//            12hr time
            shortTime = setNewTime.toLocaleTimeString(navigator.language, {hour: '2-digit', minute: '2-digit'});

            $('#timeline').append("<tr><td class='edit btn-link' >Edit</td><td class='remove btn btn-link'>Remove</td><td class='hidden'>"+$minutes+"</td><td>"+shortTime+"</td><td class='hidden'>"+longTime+"</td><td>"+$shot+"</td><td class='hidden'>"+$shots+"</td><td class='hidden'>"+$tips+"</td></tr>");


            //This hides the hidden colapsed rows

            $row.addClass('hidden');
            $row2 = $(this).closest('tr').next('tr');
            $row3 = $row2.next('tr');
            $row2.addClass('hidden');
            $row3.addClass('hidden');
        });
        $('#custPre').on('click', function () {

            $minutes = $( "input[name='custTime']" ).val();
            $shot = $( "input[name='custShot']" ).val();
            $shots = $("#custShotsList").val();
            $tips = $("#custShotTips").val();

            setDate = $('#ceremony-date-id').val();
            setStartTime = $('#timeline tr:first td:nth-child(5)').text();
            setShotTime = $('#timeline tr:first td:nth-child(3)').text();


            setDateTime = setDate + ',' + setStartTime;
            setDateTime = new Date(setDateTime);
            setNewTime = subtractMinutes(setDateTime, $minutes);

            shortHour = setNewTime.getHours();
            shortMin = setNewTime.getMinutes();
            longTime = shortHour + ":" + shortMin;
            shortTime = setNewTime.toLocaleTimeString(navigator.language, {hour: '2-digit', minute: '2-digit'});
            $('#timeline').prepend("<tr><td class='edit btn-link' >Edit</td><td class='remove btn btn-link'>Remove</td><td class='hidden'>"+$minutes+"</td><td>"+shortTime+"</td><td class='hidden'>"+longTime+"</td><td>"+$shot+"</td><td class='hidden'>"+$shots+"</td><td class='hidden'>"+$tips+"</td></tr>");
            $('#custShotForm').trigger("reset");
            $('#custShotsList').val("");
            $('#custShotModal').modal('hide');


        });
        $('#custPost').on('click', function () {

            $minutes = $( "input[name='custTime']" ).val();
            $shot = $( "input[name='custShot']" ).val();
            $shots = $("#custShotsList").val();
            $tips = $("#custShotTips").val();



            setDate = $('#ceremony-date-id').val();
            setStartTime = $('#timeline tr:last td:nth-child(5)').text();
            setShotTime = $('#timeline tr:last td:nth-child(3)').text();


            setDateTime = setDate + ',' + setStartTime;
            setDateTime = new Date(setDateTime);
            setNewTime = addMinutes(setDateTime, setShotTime);

            shortHour = setNewTime.getHours();
            shortMin = setNewTime.getMinutes();
            longTime = shortHour +":"+ shortMin;
            shortTime = setNewTime.toLocaleTimeString(navigator.language, {hour: '2-digit', minute:'2-digit'});

            $('#timeline').append("<tr><td class='edit btn-link' >Edit</td><td class='remove btn btn-link'>Remove</td><td class='hidden'>"+$minutes+"</td><td>"+shortTime+"</td><td class='hidden'>"+longTime+"</td><td>"+$shot+"</td><td class='hidden'>"+$shots+"</td><td class='hidden'>"+$tips+"</td></tr>");
            $('#custShotForm').trigger("reset");
            $('#custShotsList').val("");
            $('#custShotModal').modal('hide');


        });
//        This is the edit button on the timeline table

        $('body').on('click', '.edit', function() {
            $("#myModal").modal("show");
            $shot = $(this).parent().find("td:nth-child(6)").text();
            $time = $(this).parent().find("td:nth-child(3)").text();
            $shots = $(this).parent().find("td:nth-child(7)").text();
            $tips = $(this).parent().find("td:nth-child(8)").text();
            $('#shot').val($shot);
            $('#time').val($time);
            $('#shots').val($shots);
            $('#tips').val($tips);
            $(this).parent().remove();

        });
//        This is the save button on the shot edit modal
        $('#editModal').on('click', function(){

            //            add row to the table

            $minutes = $('#time').val();
            $shot2 =  $('#shot').val();
            setDate = $('#ceremony-date-id').val();
            setStartTime = $('#timeline tr:last td:nth-child(5)').text();
            setShotTime = $('#timeline tr:last td:nth-child(3)').text();
            $shots2 = $('#shots').val();

            $tips = $('#tips').val();


            setDateTime = setDate + ',' + setStartTime;
            setDateTime = new Date(setDateTime);
            setNewTime = addMinutes(setDateTime, setShotTime);

            shortHour = setNewTime.getHours();
            shortMin = setNewTime.getMinutes();
            longTime = shortHour +":"+ shortMin;
            shortTime = setNewTime.toLocaleTimeString(navigator.language, {hour: '2-digit', minute:'2-digit'});

            $('#timeline').append("<tr><td class='edit btn-link' >Edit</td><td class='remove btn btn-link'>Remove</td><td class='hidden'>"+$minutes+"</td><td>"+shortTime+"</td><td class='hidden'>"+longTime+"</td><td>"+$shot2+"</td><td class='hidden'>"+$shots2+"</td><td class='hidden'>"+$tips+"</td></tr>");
//            $('#timeline').append("<tr><td colspan='4'><ul>"+$shots+"</ul></td></tr>");

            $('#myModal').modal('hide');
        });

//    Removes row from dynamic table

        $('body').on('click', '.remove', function() {
            $(this).parent().remove();
        });


    //function to add minutes to get the next shots time

        function addMinutes(date, minutes) {

            return new Date(date.getTime() + minutes*60000);
        }
    //function to subtracts minutes to get the next shots time

        function subtractMinutes(date, minutes) {

            return new Date(date.getTime() - minutes*60000);


        }


//        Creates Datatables plugin tables

//        $(document).ready(function(){
//            $('.tableDisplay').DataTable();
//            ({
//
//                searching: false,
//                paging: false,
//                info:     false
//            });
//            $('#timeline').DataTable();

//        });

//        This adds shots to the list on the custom shots page

        $('#custShotBtn').on('click', function(){
            var $shots = $('#custShotsList').val();
            var $shot = $('#custShots').val();
            $('#custShotsList').val($shots+"<li>"+$shot+"</li>");
            $('#custShots').val('');



        });

//        This shows the custom shots page
        $('#custModalBtn').on('click', function () {


            $("#custShotModal").modal("show");

        });

//        This closes and clears the form for the custom shots page
        $('#closeCustModal').on('click', function () {

            $('#custShotForm').trigger("reset");
            $('#custShotsList').val("");
            $('#custShotModal').modal('hide');
        })

    </script>


@stop