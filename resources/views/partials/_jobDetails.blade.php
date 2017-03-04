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