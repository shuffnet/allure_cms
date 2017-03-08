@extends('main')

@section('content')

    <div class="row">
        <div class="col col-md-4">
            <h3>Packages</h3>

            <table class="table">
                <thead>
                <th>Type</th>
                <th>Name</th>
                <th>Price</th>
                <th></th>
                </thead>
                <tbody>
                @foreach($packages as $package)
                    <tr><td>{{$package->type_id}}</td><td>{{$package->name}}</td><td>{{$package->price}}</td><td><a href="">edit</tr>

                @endforeach

                </tbody>



            </table>



        </div>

        <div class="col col-md-3">

            <h3>Create New Package</h3>
            <hr>
            {!! Form::open(array('route' => 'packages.store')) !!}

            {{Form::label('type_id','Type:')}}
            {{Form::text('type_id', null, array('class'=> 'form-control'))}}
            {{Form::label('name','Name:')}}
            {{Form::text('name', null, array('class'=> 'form-control'))}}
            {{Form::label('price','Price:')}}
            {{Form::text('price', null, array('class'=> 'form-control'))}}
            <label for="retail" class="">Retail:</label>
            <input type="text" name="retail" id="retail" class="form-control">
                <table id="package-product">
                    <thead>

                    </thead>
                    <tbody>

                    </tbody>


                </table>

            {{Form::submit('Save', array('class'=> 'btn btn-success btn-lg btn-block'))}}
            {!! Form::close() !!}
        </div>
        <div class="col col-md-3">
                <h3>Products</h3>
            <table class="table" id="products">
                <thead>
                <th></th>
                <th>Type</th>
                <th>Item</th>
                <th></th>
                <th></th>
                </thead>
                <tbody>
                @foreach($products as $product)

                    <tr><td><div class="btn btn-default addBtn">Add</div></td><td>{{$product->type_id}}</td><td>{{$product->item}}</td><td>{{$product->price}}</td><td><a href="{{ route('order_type.edit', $product->id) }}">edit</a></tr>

                @endforeach

                </tbody>



            </table>




        </div>





    </div>


    </div>

@stop
@section('java')
    <script type="text/javascript">
        $(document).ready(function(){
            $('#package-product').DataTable();
        });


        $('#products .addBtn').on('click',function(){
            var $row = $(this).closest("tr"),        // Finds the closest row <tr>
                $product = $row.find("td:nth-child(3)"); // Finds the 2nd <td> element
                $price = $row.find("td:nth-child(4)"); // Finds the 2nd <td> element
            $('#package-product tbody').append('<tr><td><a class="removebutton" style="">remove</a><td>'+$product.text()+'</td><td class="add text-right">'+$price.text()+'</td></tr>');
          var $newproduct = $product.text();
          var $price = $price.text();
          calculateSum();

        });

        $(document).on('click', '.removebutton', function () { // <-- changes

            $(this).closest('tr').remove();
            calculateSum();
            return false;

        });

        function calculateSum() {


            var sum = 0;

            $('.add').each(function()
            {
                sum += parseFloat($(this).text());


            });

            $('#retail').val(sum);




        };
    </script>
    @stop
