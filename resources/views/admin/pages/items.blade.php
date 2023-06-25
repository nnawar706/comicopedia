@extends('admin.layouts.datatable-default')

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-10 offset-lg-1">
            <!-- Page Heading -->
        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin-dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Series</li>
            </ol>
        </nav>

            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                @if(auth()->guard('admin')->user()->hasPermissionTo('add series'))
                    <a href="{{ route('create-item-view') }}">
                        <button style="margin-bottom:30px;" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModalSeries">
                            Add Series
                        </button>
                    </a>
                @endif
                @if(auth()->guard('admin')->user()->hasPermissionTo('export series'))
                    <a href="{{ route('export-series') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                        class="fas fa-download fa-sm text-white-50"></i> Export Series
                    </a>
                @endif
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-10 offset-lg-1">
            @livewire('item-table')
        </div>
    </div>
</div>


@stop
