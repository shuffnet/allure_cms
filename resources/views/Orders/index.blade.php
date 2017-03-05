@extends('main')

@section('content')

    <div class="row">
        <div class="col col-md-4">
            <h3>Orders</h3>

            <table class="table" id="ordersTable">
                <thead>
                <th>Type</th>
                <th>Client</th>
                <th>Date</th>
                <td></td>
                <td></td>
                </thead>
                <tbody>
                @foreach($orders as $order)
                    <tr><td>{{$order->orderType->type}}</td><td>{{$order->contact->fname." ".$order->contact->lname}}</td><td>{{ Carbon\Carbon::parse($order->orderDate)->format('M-d-Y ') }}</td><td><a href="">View</a></td><td><a href=" ">edit</a></td></tr>

                @endforeach

                </tbody>



            </table>



        </div>







    </div>




@stop
@section('java')
    <script>
        $(document).ready(function(){
            $('#ordersTable').DataTable();
        });

    </script>

@stop