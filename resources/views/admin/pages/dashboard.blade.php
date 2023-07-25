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
            <div class="col-lg-8 mb-4">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Order Locations</h6>
                    </div>
                    <div class="card-body" style="height: 354px !important;">
                        {{-- <div style="width: 100%;height: 100%; margin: 0" id="order-map"></div> --}}
                    </div>
                </div>
            </div>
            <div class="col-lg-4 mb-4">
                <!-- Comic Card -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Catalogues</h6>
                        <div class="dropdown no-arrow"></div>
                        <a href="#" role="button" id="dropdownMenuLink"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                             aria-labelledby="dropdownMenuLink">
                            <button class="dropdown-item" onclick="downloadPieChart()">Download</button>
                            <button class="dropdown-item" onclick="exportPieChartPDF()">Export PDF</button>
                        </div>
                    </div>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="chart-pie pt-4 pb-2">
                        <canvas id="cataloguePieChart"></canvas>
                    </div>
                    <div class="mt-4 text-center small">
                        <span class="mr-2">
                            <i class="fas fa-circle text-primary"></i> New Arrivals
                        </span>
                                <span class="mr-2">
                            <i class="fas fa-circle text-success"></i> Upcoming Releases
                        </span>
                        <span class="mr-2">
                            <i class="fas fa-circle text-info"></i> Bestsellers
                        </span>
                        <span class="mr-2">
                            <i class="fas fa-circle text-danger"></i> Featured
                        </span>
                        <span class="mr-2">
                            <i class="fas fa-circle text-dark"></i> Offers
                        </span>
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
<!-- Page level plugins -->
<script src="{{ asset('assets/js/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/js/datatables/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/js/charts/datatables-demo.js') }}"></script>
{{-- <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
<script src="{{ asset('assets/js/order-map.js') }}"></script> --}}

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
