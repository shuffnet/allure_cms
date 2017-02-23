@extends('main')

@section('content')

<div class="row">
    <?php
    use Carbon\Carbon;
    $jobDate = new Carbon($job->date)
    ?>
     <div class="col col-md-8">
       <h2>{{$job->job_type->type}}</h2>
       <p class="lead">{{$job->name." ".$jobDate->format('l F jS \\  Y')}}</p>
       <p class="lead">{{$job->description}}</p>
         <div class="row">
             <div class="col col-md-6">
                 @foreach($job->contacts as $contact)

                     <h4>{{$contact->fname. " ". $contact->lname}}</h4>
                     <h4>{{$contact->email}}</h4>
                     <h4>{{$contact->phone}}</h4>


                 @endforeach

             </div>

         </div>



     </div>

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