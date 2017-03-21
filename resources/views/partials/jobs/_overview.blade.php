{{--Middle Section--}}
<div id="overviewsection" class="row">
    <div class="container-fluid"> <!--Center Content Container-->
        <div class="row-fluid">
            <div class="col col-md-3">

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
            <div class="col col-md-9"> <!--Center Content Section-->
                @include('partials/_orderForm')
                @include('partials/_jobOrders')



            </div> <!--Center Content Section-->
            {{--<div class="col col-md-4 well"> <!--Start of Notes Section-->--}}
            {{--<p>This is where notes will be</p>--}}

            {{--</div> <!--End of Notes Section-->--}}

        </div>
    </div>
</div>