@extends('admin.layouts.default')

@if (session('message'))
    <div class="toast show fixed-bottom ms-auto text-bg-danger" style="--bs-bg-opacity: .8;" animation="true" aria-live="assertive" aria-atomic="true">
        <div class="d-flex">
            <div class="toast-body">
                {{ session('message') }}
            </div>
        </div>
    </div>
@endif

@section('content')
    <div class="container-fluid">
        <!-- Page Heading -->
        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin-dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('show-volumes') }}">Series</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $data['item']['title']}}, {{ $data['title'] }}</li>
            </ol>
        </nav>

        @include('admin.includes.volumes.top')

        @include('admin.includes.volumes.info')

        <div class="row">
            @include('admin.includes.volumes.order-chart')
            @include('admin.includes.volumes.review')
        </div>
    </div>

@stop

@push('scripts')

<script src="{{ asset('assets/chart.js/Chart.min.js') }}"></script>
<script src="{{ asset('assets/js/charts/chart-area-demo.js') }}"></script>

@endpush
