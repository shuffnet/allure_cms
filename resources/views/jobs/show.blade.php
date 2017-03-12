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
            <div class="col col-md-8"> <!--Center Content Section-->
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
        $(document).ready(function(){
            $('#ordersTable').DataTable({

                searching: false,
                paging: false,
                info:     false
            });
            $('#timeline').DataTable({

                searching: false,
                paging: false,
                info:     false
            });
        });

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


            $('#timeline').append("<tr><td class='hidden'>0</td><td>"+pbreakShort+"</td><td class='hidden'>"+pbreakTotal+"</td><td>Photographers Break</td></tr>");

            $('#timeline').append("<tr><td class='hidden'>0</td><td>"+setupShort+"</td><td class='hidden'>"+setupTotal+"</td><td>Photographers Setup For Ceremony</td></tr>");

            $('#timeline').append("<tr><td class='hidden'>0</td><td>"+ceremonyStartShort+"</td><td class='hidden'>"+ceremonyStartTime+"</td><td> Ceremony Start Time</td></tr>");
            $('#timeline').append("<tr><td class='hidden'>0</td><td>"+ceremonyEndShort+"</td><td class='hidden'>"+ceremonyEndTime+"</td><td> Ceremony End Time</td></tr>");



              var minutes = $('tr:last td:first').text();
              var time = $('tr:last td:nth-child(3)').text();
//              alert(minutes+','+time);


        })

        $('#shotListTable .addPost').on('click',function(){
            var $row = $(this).closest("tr");       // Finds the closest row <tr>
            $minutes = $row.find("td:nth-child(1)").text();
            $shot =  $row.find("td:nth-child(2)").text();
            setDate = $('#ceremony-date-id').val();
            setStartTime = $('#timeline tr:last td:nth-child(3)').text();
            setShotTime = $('#timeline tr:last td:nth-child(1)').text();


            setDateTime = setDate + ',' + setStartTime;
            setDateTime = new Date(setDateTime);
            setNewTime = addMinutes(setDateTime, setShotTime);

           shortHour = setNewTime.getHours();
           shortMin = setNewTime.getMinutes();
           longTime = shortHour +":"+ shortMin;
           shortTime = setNewTime.toLocaleTimeString(navigator.language, {hour: '2-digit', minute:'2-digit'});

            $('#timeline').append("<tr><td class='hidden'>"+$minutes+"</td><td>"+shortTime+"</td><td class='hidden'>"+longTime+"</td><td>"+$shot+"</td></tr>");
            $row.addClass('hidden');
        });

        $('#shotListTable .addPre').on('click',function() {
            var $row = $(this).closest("tr");       // Finds the closest row <tr>
            $minutes = $row.find("td:nth-child(1)").text();
            $shot = $row.find("td:nth-child(2)").text();
            setDate = $('#ceremony-date-id').val();
            setStartTime = $('#timeline tr:first td:nth-child(3)').text();
            setShotTime = $('#timeline tr:first td:nth-child(1)').text();


            setDateTime = setDate + ',' + setStartTime;
            setDateTime = new Date(setDateTime);
            setNewTime = subtractMinutes(setDateTime, $minutes);

            shortHour = setNewTime.getHours();
            shortMin = setNewTime.getMinutes();
            longTime = shortHour + ":" + shortMin;
            shortTime = setNewTime.toLocaleTimeString(navigator.language, {hour: '2-digit', minute: '2-digit'});
            $('#timeline').prepend("<tr><td class='hidden'>"+$minutes+"</td><td>"+shortTime+"</td><td class='hidden'>"+longTime+"</td><td>"+$shot+"</td></tr>");
            $row.addClass('hidden');
        });

        function addMinutes(date, minutes) {

            return new Date(date.getTime() + minutes*60000);
        }
        function subtractMinutes(date, minutes) {

            return new Date(date.getTime() - minutes*60000);


        }

    </script>


@stop