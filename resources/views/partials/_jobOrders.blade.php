
<div class="hidden">

<h3>Orders for this job</h3>
<table class="" id="ordersTable">
    <thead>
    <th></th>
    <th></th>
    <th>#</th>
    <th>Type</th>
    <th>Name</th>
    <th>Date</th>
    <th>Total</th>
    {{--<th></th>--}}
    </thead>
    <tbody>

    @foreach($orders as $order)
        <tr>

            <?php
            $orderDate = new Carbon($order->orderDate)
            ?>
            <td><a href="" class="btn btn-default">View</a></td>
            <td><a href="" class="btn btn-default">Edit</a></td>
            <td>{{$order->id}}</td>
            <td>{{$order->type}}</td>
            <td>{{$order->fname. " ". $order->lname}}</td>

            <td>{{isset($orderDate) ? $orderDate->format(' F jS \\  Y') : 'No Date' }}</td>
            {{--<td><a href="{{ route('jobs.show',$job->id)}}" class="btn btn-default btn-sm">View</a>--}}
                {{--<a href="{{ route('jobs.edit', $job->id) }}" class="btn btn-default btn-sm">Edit</a></td>--}}
            <td></td>
        </tr>
    @endforeach

    </tbody>


</table>

</div>