@extends('main')

@section('content')

<div class="row">
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

     <div class="col col-md-8">
         <div class="row">
             <div class="col col-md-12">
               <h4>{{$job->job_type->type. " ".$jobDate}}</h4>

             </div>
             <div class="col col-md-4">
                 @foreach($job->role as $role)

                     <h4>{{$role->role}}</h4>



                 @endforeach

             </div>


         </div>



         <div class="row">
             <div class="col col-md-6 well">
                 @foreach($job->contacts as $contact)

                     <h4>{{$contact->fname. " ". $contact->lname}}</h4>
                     <h4>{{$contact->email}}</h4>
                     <h4>{{$contact->phone}}</h4>


                 @endforeach

             </div>


         </div>
         <div class="row">
             <div class="col col-md-6 well">
                 <p class="lead">{{$job->description}}</p>
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