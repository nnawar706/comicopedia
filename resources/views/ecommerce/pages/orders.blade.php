@extends('ecommerce.layouts.default')

@section('content')

    @include('ecommerce.includes.general.navbar')
    @include('ecommerce.includes.order.breadcrumb')

    <section class="shoping-cart spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    @if(count($data) === 0)
                        <p style="text-align: center">No Order Found.</p>
                    @else
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Order Number</th>
                                <th scope="col">Tracking ID</th>
                                <th scope="col">Total Items</th>
                                <th scope="col">Total Payable</th>
                                <th scope="col">Status</th>
                                <th scope="col"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($data as $key => $item)
                                <tr @if($item['status']['name']=='Cancelled')
                                        class="table-danger"
                                    @elseif($item['status']['name']=='Delivered')
                                        class="table-success"
                                    @endif>
                                    <th scope="row">{{ $key+1 }}</th>
                                    <td>{{ $item['order_no'] }}</td>
                                    <td>{{ $item['delivery_tracking_no'] }}</td>
                                    <td>{{ $item['items_count'] }}</td>
                                    <td>&#2547; {{ $item['total']+$item['shipping_cost']-$item['promo_discount'] }}</td>
                                    <td>{{ $item['status']['name'] }}</td>
                                    <td><a href="{{ route('order-detail-pdf', ['id' => $item['id']]) }}"><i class="fa fa-file-pdf" style="color:#1c1c1c;"></i></a></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        </div>
    </section>

@stop
