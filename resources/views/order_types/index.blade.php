

@extends('main')

@section('content')

    <div class="row">
        <div class="col col-md-4">
            <h3>Job Types</h3>

            <table class="table">
                <thead>
                <th>Type</th>
                <th></th>
                <th></th>
                </thead>
                <tbody>
                @foreach($order_types as $order_type)
                    <tr><td>{{$order_type->type}}</td><td><a href="{{ route('order_type.edit', $order_type->id) }}">edit</a></tr>

                @endforeach

                </tbody>



            </table>



        </div>

        <div class="col col-md-4">

            <h3>Create New Order/Type</h3>
            <hr>
            {!! Form::open(array('route' => 'order_type.store')) !!}

            {{Form::label('type','Type:')}}
            {{Form::text('type', null, array('class'=> 'form-control'))}}

            {{Form::submit('Save', array('class'=> 'btn btn-success btn-lg btn-block'))}}
            {!! Form::close() !!}
        </div>





    </div>


    </div>

@stop
