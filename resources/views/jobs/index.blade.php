<?php
use Carbon\Carbon;
?>

@extends('main')

@section('content')



   <div class="row">
       <div class="col col-md-10"><h1>All Jobs</h1></div>
       <div class="col col-md-2"><a href="{{route('jobs.create')}}" class="btn btn-block btn-primary">Create New Job</a></div>

   </div>
   <hr>
    <div class="row">
        <div class="col col-md-12">
            <table class="" id="jobsTable">
                <thead>
                   <th>#</th>
                    <th>Type</th>
                    <th>Name</th>
                    <th>Date</th>
                    <th>Created</th>
                    <th></th>
                </thead>
                <tbody>
                    @foreach($jobs as $job)
                        <tr>
                            {{$jobDate = new Carbon($job->date)}}

                            <th>{{$job->id}}</th>
                            <td>{{$job->job_type->type  or 'No Type'}}</td>
                            <td>{{$job->name}}</td>

                            <td>{{isset($jobDate) ? $jobDate->format('l F jS \\  Y') : 'No Date' }}</td>
                            <td>{{isset($job->updated_at) ? $job->updated_at->format(' M j Y , g:ia') : "No Date"}}</td>
                            <td><a href="{{ route('jobs.show',$job->id)}}" class="btn btn-default btn-sm">View</a>
                                <a href="{{ route('jobs.edit', $job->id) }}" class="btn btn-default btn-sm">Edit</a></td>

                        </tr>
                    @endforeach

                </tbody>


            </table>

        </div>
    </div>

@stop

@section('java')
    <script>
        $(document).ready(function(){
            $('#jobsTable').DataTable();
        });

    </script>

@stop