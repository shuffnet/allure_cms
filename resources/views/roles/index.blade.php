@extends('main')

@section('content')

    <div class="row">
        <div class="col col-md-4">
            <h3>Roles</h3>

            <table class="table">
                <thead>
                <th>Role</th>
                <th></th>
                <th></th>
                </thead>
                <tbody>
                @foreach($roles as $role)
                    <tr><td>{{$role->role}}</td><td><a href="{{ route('roles.edit', $role->id) }}">edit</tr>

                @endforeach

                </tbody>



            </table>



        </div>

        <div class="col col-md-4">

            <h3>Create New Job/Type</h3>
            <hr>
            {!! Form::open(array('route' => 'roles.store')) !!}

            {{Form::label('role','Role:')}}
            {{Form::text('role', null, array('class'=> 'form-control'))}}

            {{Form::submit('Save', array('class'=> 'btn btn-success btn-lg btn-block'))}}
            {!! Form::close() !!}
        </div>





    </div>


    </div>

@stop
