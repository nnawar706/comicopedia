@extends('admin.layouts.default')

@section('content')

    <div class="container-fluid">
        <!-- Page Heading -->
        @include('admin.includes.dashboard.header')

        <!-- Report Row -->
        @include('admin.includes.dashboard.reports')

        <!-- Chart Row -->
        @include('admin.includes.dashboard.charts')

        <!-- Content row -->
        <div class="row">
            <div class="col-lg-6 mb-4">
                <!-- Comic Card -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Most Viewed Volumes</h6>
                    </div>
                    <div class="card-body">
                        @php
                            $bg_colors = ['bg-success','bg-warning','','bg-info','bg-danger'];
                        @endphp
                        @foreach ($data['most_viewed']['data'] as $key=>$item)
                        <h4 class="small font-weight-bold"><a href="" style="color:dimgray">{{ $item['item']['title'] }}, {{ $item['title'] }} </a><span
                                class="float-right">{{ round(($item['view_count']/$data['most_viewed']['total'])*100,2) }}%</span></h4>
                        <div class="progress mb-4">
                            <div class="progress-bar {{ $bg_colors[$key] }}" role="progressbar" style="width: {{ round(($item['view_count']/$data['most_viewed']['total'])*100,2) }}%"
                                aria-valuenow="{{ round(($item['view_count']/$data['most_viewed']['total'])*100,2) }}" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-lg-6 mb-4">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Order Locations</h6>
                    </div>
                    <div class="card-body" style="height: 354px !important;">
{{--                        <div style="width: 100%;height: 100%; margin: 0" id="order-map"></div>--}}
                    </div>
                </div>
            </div>
        </div>

        @include('admin.includes.dashboard.orders')
    </div>

@stop

@push('scripts')

<script src="{{ asset('assets/chart.js/Chart.min.js') }}"></script>
<script src="{{ asset('assets/js/charts/chart-area-demo.js') }}"></script>
<script src="{{ asset('assets/js/charts/chart-pie-demo.js') }}"></script>
<script src="{{ asset('assets/js/charts/order-chart-bar.js') }}"></script>
{{--<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>--}}
{{--<script src="{{ asset('assets/js/order-map.js') }}"></script>--}}

<script>
    document.addEventListener('DOMContentLoaded', function() {

        let read = document.getElementsByClassName('markRead');

        read[0].addEventListener('click', function(event) {
            event.preventDefault();

            let alert_id = read[0].getAttribute("data-notification-id");

            fetch('/admin/read-notification?id=' + alert_id)
                .then(function redirect() {
                    window.location.href = read[0].href;
                })
        })
    })
</script>

@endpush
