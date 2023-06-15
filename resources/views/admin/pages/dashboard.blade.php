@extends('admin.layouts.default')

@section('content')

    <div class="container-fluid">
        <!-- Page Heading -->
        @include('admin.includes.dashboard-header')

        <!-- Report Row -->
        @include('admin.includes.reports')

        <!-- Chart Row -->
        @include('admin.includes.dashboard-charts')
    </div>

@stop
