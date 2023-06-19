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
    <div class="row">
        <div class="col-lg-8 offset-lg-2">
            <br>
            <h5 class="h5 mb-1 text-gray-800">Series</h5>
            <br>
            <a href="{{ route('create-item-view') }}">
                <button style="margin-bottom:30px;" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModalSeries">
                    Add Series
                </button>
            </a>

            @include('admin.includes.items.create')
        </div>
    </div>
</div>


@stop