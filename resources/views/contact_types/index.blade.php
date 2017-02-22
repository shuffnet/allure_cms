@extends('main')

@section('content')

    <div class="row">
        <div class="col col-md-4">
            <h3>Contact Types</h3>

            <table class="table">
                <thead>
                <th>Type</th>
                <th></th>
                <th></th>
                </thead>
                <tbody>
                @foreach($contact_types as $contact_type)
                    <tr><td>{{$contact_type->type}}</td><td><a href="{{ route('contact_types.edit', $contact_type->id) }}">edit</a><td></tr>

                @endforeach

                </tbody>



            </table>



        </div>

        <div class="col col-md-4">

            <h3>Create New Contact Type</h3>
            <hr>
            {!! Form::open(array('route' => 'contact_types.store')) !!}

            {{Form::label('type','Type:')}}
            {{Form::text('type', null, array('class'=> 'form-control'))}}

            {{Form::submit('Save', array('class'=> 'btn btn-success btn-lg btn-block'))}}
            {!! Form::close() !!}
        </div>





    </div>


    </div>

@stop