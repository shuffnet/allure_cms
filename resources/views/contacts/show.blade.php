@extends('main')

@section('content')

    <div class="row">

        <div class="col col-md-7 col-md-offset-1">
            <p class="lead">{{$contact->fname}}</p>
            <p class="lead">{{$contact->lname}}</p>
            <p class="lead">{{$contact->email}}</p>

            <hr>
            <div class="row"><h5>Roles:</h5></div>

            <div>
                @foreach($contact->contact_type as $type)

                    <span class="label label-default">{{$type->role}}</span>


                @endforeach




            </div>
            <hr>
            <div>
                <div class="row"><h5>Default Roles:</h5></div>
                @foreach($contact->default_role as $default)

                    <span class="label label-default">{{$default->role}}</span>


                @endforeach
            </div>
            <hr>



        </div>
        <div class="col col-md-4">
            <div class="well">
                <div class="row">



                    <dl class="dl-horizontal">
                        <dt>Create at:</dt>
                        <dd>{{$contact->created_at->diffForHumans()}}</dd>
                        <dd>{{$contact->created_at->format(' M j Y , g:ia') }}</dd>


                    </dl>
                    <dl class="dl-horizontal">
                        <dt>Last Updated:</dt>
                        <dd>{{$contact->updated_at->diffForHumans()}}</dd>
                        <dd>{{$contact->updated_at->format(' M j Y , g:ia') }}</dd>


                    </dl>


                </div>


                <div class="row">
                    <div class="col-sm-6">

                        <a href="{{ route('contacts.edit', $contact->id) }}" class="btn btn-primary btn-block">Edit</a></td>

                    </div>
                    <div class="col-sm-6">
                        {!! Form::open(['route' => ['contacts.destroy', $contact->id], 'method'=>'DELETE']) !!}

                        {{Form::submit('Delete', array('class'=> 'btn btn-danger  btn-block'))}}
                        {!! Form::close() !!}
                    </div>
                </div>


            </div>
        </div>




    </div>


@endsection