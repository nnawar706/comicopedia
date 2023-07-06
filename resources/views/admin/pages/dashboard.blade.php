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
                <!-- Not Decided Yet -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Illustrations</h6>
                    </div>
                    <div class="card-body">
                        <div class="text-center">
                            <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 25rem;"
                                 src="" alt="...">
                        </div>
                        <p>Add some quality, svg illustrations to your project courtesy of <a
                                target="_blank" rel="nofollow" href="https://undraw.co/">unDraw</a>, a
                            constantly updated collection of beautiful svg images that you can use
                            completely free and without attribution!</p>
                        <a target="_blank" rel="nofollow" href="https://undraw.co/">Browse Illustrations on
                            unDraw &rarr;</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

@stop

@push('scripts')

<script src="{{ asset('assets/chart.js/Chart.min.js') }}"></script>
<script src="{{ asset('assets/js/charts/chart-area-demo.js') }}"></script>
<script src="{{ asset('assets/js/charts/chart-pie-demo.js') }}"></script>

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
