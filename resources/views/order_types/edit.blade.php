@extends('main')

@section('content')

    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <h3>Edit Job type</h3>
            <hr>
            {!! Form::model($order_type, ['route'=>['order_type.update', $order_type->id], 'method'=> 'PUT']) !!}

            {{Form::label('type','Order Type:')}}
            {{Form::text('type', null, array('class'=> 'form-control'))}}
            <div class="col-sm-6">

                {{Form::submit('Update', array('class'=> 'btn btn-success btn-lg btn-block'))}}

            </div>
            {!! Form::close() !!}

            <div class="col-sm-6">
                {!! Form::open(['route' => ['order_type.destroy', $order_type->id], 'method'=>'DELETE']) !!}

                {{Form::submit('Delete', array('class'=> 'btn btn-danger  btn-block'))}}
                {!! Form::close() !!}
            </div>

        </div>
    </div>

@endsection