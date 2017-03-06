@extends('main')

@section('content')

    <div class="row">
        <div class="col col-md-4">
            <h3>Product/Service</h3>

            <table class="table">
                <thead>
                <th>Type</th>
                <th></th>
                <th></th>
                </thead>
                <tbody>
                @foreach($productServices as $product)
                    <tr><td>{{$product->type}}</td><td><a href="{{ route('order_type.edit', $product->id) }}">edit</a></tr>

                @endforeach

                </tbody>



            </table>



        </div>
        {{----}}









        <div class="col col-md-4">

            <h3>Create New Product/Service</h3>
            <hr>
            {!! Form::open(array('route' => 'productServices.store')) !!}
            <select name="type_id" id="" class="form-control">
                <option disabled selected value="">Select Type</option>
                <option value="1">Product</option>
                <option value="2">Service</option>
                <option value="3">Session</option>





            {{Form::label('item','Item/Service:')}}
            {{Form::text('item', null, array('class'=> 'form-control'))}}
            </select>
            <div class="checkbox">
                <label>
                    <input name="taxable" type="checkbox" value="1" checked>
                    <span class="cr"></span>
                    Taxable
                </label>
            </div>

            {{Form::label('price','Price $:')}}
            {{Form::text('price', 0, array('class'=> 'form-control'))}}
            {{Form::label('discount','Discount %:')}}
            {{Form::text('discount', 0, array('class'=> 'form-control'))}}
            {{Form::label('product_cost','Product Cost $:')}}
            {{Form::text('product_cost', 0, array('class'=> 'form-control'))}}
            {{Form::label('labor_cost','Labor Cost $:')}}
            {{Form::text('labor_cost', 0, array('class'=> 'form-control'))}}
            {{Form::label('description','Description:')}}
            {{Form::textarea('description',null , array('class'=> 'form-control'))}}
            {{Form::label('tips','Tips:')}}
            {{Form::textarea('tips',null , array('class'=> 'form-control'))}}
            {{Form::label('requirements','Requirements:')}}
            {{Form::textarea('requirements',null , array('class'=> 'form-control'))}}
            {{Form::submit('Save', array('class'=> 'btn btn-success btn-lg btn-block'))}}

            {!! Form::close() !!}
        </div>





    </div>


    </div>

@stop
