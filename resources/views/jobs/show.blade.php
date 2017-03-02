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
            <div class="col col-md-8"> <!--Job Name Column-->
                <div class="row ">
                    <div class="col col-md-12">
                        <h3><a href="">{{$job->name." "}}</a>{{$jobDate}}</h3>
                    </div>
                </div>
                <div class="row">
                    @if (isset($lead))

                        <div class="col col-md-8">
                            <h4 class=""><small>Photographed by:
                                </small> {{$lead->fname." ".$lead->lname}}</h4>
                        </div>
                </div>
                @else
                    <div class="col col-md-3">
                        <h4 class="text-right"><small>Photographed by:</small></h4>
                    </div>
                    <div class="col col-md-4">
                        <form action="">
                            {{ csrf_field() }}
                            <select name="photog" id="photog" class="form-control">
                                <option value="" disabled selected>Select Job Type</option>
                                @foreach($photogs as $photog)
                                    <option value="{{$photog->id}}">{{$photog->fname." ".$photog->lname}}</option>
                                @endforeach

                            </select>
                            <div class="col col-md-1">
                                <div id="add-existing-contact" class="btn btn-link">Save</div>
                            </div>
                        </form>

                    </div>


            </div> <!--End Job Name Column-->

            @endif



        </div> <!--End of job name column-->
        <div class="col col-md-4"> <!--Job Edit Column-->
            <div class="well">
                <div class="row">
                    <dl class="dl-horizontal">
                        <dt>Create at:</dt>
                        <dd>{{$job->created_at->diffForHumans()}}</dd>
                        <dd>{{$job->created_at->format(' M j Y , g:ia') }}</dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt>Last Updated:</dt>
                        <dd>{{$job->updated_at->diffForHumans()}}</dd>
                        <dd>{{$job->updated_at->format(' M j Y , g:ia') }}</dd>
                    </dl>
                </div>
                <div class="row">
                    <div class="col-sm-6">

                        <a href="{{ route('jobs.edit', $job->id) }}" class="btn btn-primary btn-block">Edit</a></td>

                    </div>
                    <div class="col-sm-6">
                        {!! Form::open(['route' => ['jobs.destroy', $job->id], 'method'=>'DELETE']) !!}

                        {{Form::submit('Delete', array('class'=> 'btn btn-danger  btn-block'))}}
                        {!! Form::close() !!}
                    </div>
                </div>


            </div>

        </div> <!--End Of Job Edit Column-->

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
            <div class="col col-md-6"> <!--Tabs Section-->


                <div id="tabs" class="well">
                    <ul>
                        <li><a href="#tabs-1">Sessions</a></li>
                        <li><a href="#tabs-2">Orders</a></li>
                        <li><a href="#tabs-3">Emails</a></li>
                        <li><a href="#tabs-4">Production</a></li>
                    </ul>
                    <div id="tabs-1">
                        <p>Sessions</p>
                    </div>
                    <div id="tabs-2">
                        <p>Orders</p>
                    </div>
                    <div id="tabs-3">
                        <p>Emails</p>
                    </div>
                    <div id="tabs-4">
                        <p>Production</p>
                    </div>
                </div>
            </div> <!--End of Tabs Section-->
            <div class="col col-md-4 well"> <!--Start of Notes Section-->
                <p>This is where notes will be</p>
            </div> <!--End of Notes Section-->

        </div>
    </div>
@endsection
@section('java')
    {{ Html::style('css/jquery-ui.css') }}
    {{ Html::style('css/jquery-ui.structure.css') }}

    {{ Html::script('js/jquery-ui.js') }}

    <script type="text/javascript">
        $(document).ready(function(){
            $('#add-existing-contact').click(function(){
                var $lead = $("#photog option:selected").val()
                var $role = '7';
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
                            window.location.reload();;
                        }
                    }
                });
            });



        });

        $( function() {
            $( "#tabs" ).tabs();
        } );
    </script>


@endsection