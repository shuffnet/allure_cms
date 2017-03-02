@extends('main')

@section('content')



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

    {{--Main Row--}}
    <div class="row ">
        <div class="col col-md-8">
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


        </div>

        @endif


        <div class="row">
            <div class="col col-md-8 well">
                <h4 class="lead"><small>{{$job->description}}</small></h4>
            </div>
        </div>



        <div class="row">


            @foreach($contacts as $contact)
                <div class="row">

                    {{--column with contacts--}}
                    <div class="col col-md-4">
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

            <div class="col col-md-6">I am here</div>

        </div>





        {{--End of contact row--}}


    </div>



    {{--Right Widget--}}

    <div class="col col-md-4">
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