@extends('admin.layouts.default')

@section('content')

<div class="container-fluid">
    <!-- Page Heading -->
    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin-dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin-list') }}">Admins</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $data['user']['name'] }}</li>
        </ol>
    </nav>
    @include('admin.includes.admins.top-info')
    @include('admin.includes.admins.user-info')
</div>

@stop
