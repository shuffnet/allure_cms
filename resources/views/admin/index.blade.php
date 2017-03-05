@extends('main')

@section('content')

    <a href="{{ route('job_types.index') }}">Job Catagories</a><br/>
    <a href="{{ route('contact_types.index') }}" class="">Contact Types</a></td><br/>
    <a href="{{ route('roles.index') }}" class="">Job Roles</a></td><br/>
    <a href="{{ route('order_type.index') }}" class="">Order Types</a></td>


@endsection