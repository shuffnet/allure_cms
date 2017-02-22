@extends('main')

@section('content')



    <div class="row">
        <div class="col col-md-10"><h1>All Jobs</h1></div>
        <div class="col col-md-2"><a href="{{route('contacts.create')}}" class="btn btn-block btn-primary">Create New Contact</a></div>

    </div>
    <hr>
    <div class="row">
        <div class="col col-md-12">
            <table class="" id="contactsTable">
                <thead>
                <th>#</th>
                <th>First</th>
                <th>Last</th>
                <th>Email</th>
                <th></th>
                </thead>
                <tbody>
                @foreach($contacts as $contact)
                    <tr>
                        <th>{{$contact->id}}</th>
                        <td>{{$contact->fname}}</td>
                        <td>{{$contact->lname}}</td>
                        <td>{{$contact->email}}</td>
                        <td><a href="{{ route('contacts.show',$contact->id)}}" class="btn btn-default btn-sm">View</a>
                            <a href="{{ route('contacts.edit', $contact->id) }}" class="btn btn-default btn-sm">Edit</a></td>

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
            $('#contactsTable').DataTable();
        });

    </script>

@stop