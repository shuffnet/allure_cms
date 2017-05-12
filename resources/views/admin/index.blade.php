@extends('main')

@section('content')

    <a href="{{ route('job_types.index') }}">Job Catagories</a><br/>
    <a href="{{ route('contact_types.index') }}" class="">Contact Types</a><br/>
    <a href="{{ route('roles.index') }}" class="">Job Roles</a><br/>
    <a href="{{ route('order_type.index') }}" class="">Order Types</a><br/>
    <a href="{{ route('productServices.index') }}" class="">Products & Services</a><br/>
    <a href="{{ route('packages.index') }}" class="">Packages</a><br/>
    <a href="{{ route('shotList.index') }}" class="">Shot List</a><br/>
    <a href="{{ route('timelinegroup.index') }}" class="">Timeline Groups</a><br/>
    <a href="{{ route('session_type.index') }}">Session Types</a><br/>
    <a href="{{ route('taskitem.index') }}">Task Items</a><br/>
    <a href="{{ route('taskgroup.create') }}">Task Groups</a>







@endsection