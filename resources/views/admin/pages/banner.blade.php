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
            <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin-dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Banners</li>
                </ol>
            </nav>
            <h6 class="h4 mb-0 text-gray-800">Banners</h6>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-lg-8 offset-lg-2">
            <div class="accordion accordion-flush" id="accordionFlushExample">
                <div class="accordion-item">
                    @include('admin.includes.banners.top')
                    @include('admin.includes.banners.about-us')
                    @include('admin.includes.banners.contact')
                </div>
            </div>
        </div>
    </div>
</div>


@stop


@push('scripts')

<script src="{{ asset('assets/js/image-preview.js') }}"></script>

<script>
    window.onload = (event) => {
        let myAlert = document.querySelector('.toast');
        let bsAlert = new bootstrap.Toast(myAlert);

        setTimeout(function () {
            bsAlert.show();
        }, 5000);
    };
</script>


@endpush
