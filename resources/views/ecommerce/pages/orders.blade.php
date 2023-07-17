@extends('ecommerce.layouts.default')

@section('content')

    @include('ecommerce.includes.general.navbar')
    @include('ecommerce.includes.order.breadcrumb')

    <section class="shoping-cart spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Order Number</th>
                                <th scope="col">Tracking ID</th>
                                <th scope="col">Total Items</th>
                                <th scope="col">Total Payable</th>
                                <th scope="col">Status</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($data as $key => $item)
                        <tr>
                            <th scope="row">{{ $key+1 }}</th>
                            <td>{{ $item['order_no'] }}</td>
                            <td>{{ $item['delivery_tracking_no'] }}</td>
                            <td>{{ $item['items_count'] }}</td>
                            <td>&#2547; {{ $item['total']+$item['shipping_cost']-$item['promo_discount'] }}</td>
                            <td>{{ $item['status']['name'] }}</td>
                            <td><a href="{{ route('order-detail-pdf', ['id' => $item['id']]) }}"><i class="fa fa-info"></i>Download Invoice</a></td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>

@stop
