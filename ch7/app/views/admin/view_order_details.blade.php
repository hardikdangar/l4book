@extends('layouts.admin')

@section('content')
<h3>Foldagram Order Details </h3>
 <table class="table table-striped table-bordered table-condensed  -table">
    <tbody>
        @if(!empty($order_detail))
                <tr>
                    <th>Transection ID   :</th>
                    <td>{{ $order_detail->transection_id }} </td>
                </tr>
                <tr>
                    <th>Quantity :</th>
                    <td>{{ $order_detail->qty }} </td>
                </tr>
                <tr>
                    <th>Price :</th>
                    <td>{{ $order_detail->price }} </td>
                </tr>
                <tr>
                    <th>Discount :</th>
                    <td>{{ $order_detail->discount_amount }} </td>
                </tr>
                 <tr>
                    <th>Total :</th>
                    <td>{{ ($order_detail->qty * $order_detail->price) - $order_detail->discount_amount }} </td>
                </tr>
                <tr>
                    <th>Email :</th>
                    <td>{{ $order_detail->email }} </td>
                </tr>
                <tr>
                    <th>Full Name :</th>
                    <td>{{ $order_detail->fullname }} </td>
                </tr>
            @endif
    </tbody>
</table>
@stop