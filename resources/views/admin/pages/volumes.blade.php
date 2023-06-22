@extends('admin.layouts.datatable-default')

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-10 offset-lg-1">
            <!-- Page Heading -->
        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin-dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Volumes</li>
            </ol>
        </nav>
            <a href="{{ route('create-volume-view') }}">
                <button style="margin-bottom:30px;" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModalSeries">
                    Add Volume
                </button>
            </a>
            @include('admin.includes.items.create')
        </div>
    </div>
    <div class="row">
        <div class="col-lg-10 offset-lg-1">
            @livewire('volume-table')
        </div>
    </div>
</div>


@stop
