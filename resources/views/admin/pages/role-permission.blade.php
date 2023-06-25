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
                    <li class="breadcrumb-item active" aria-current="page">Roles</li>
                </ol>
            </nav>
            @if(auth()->guard('admin')->user()->hasPermissionTo('role & permissions'))
                <a href="{{ route('create-role-view') }}">
                    <button style="margin-bottom:30px;" type="button" class="btn btn-primary">
                        Add Role
                    </button>
                </a>
            @endif
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-lg-8 offset-lg-2">
            <div class="accordion accordion-flush" id="accordionFlushExample">
                <div class="accordion-item">
                    @foreach($data['roles'] as $key => $item)
                        @include('admin.includes.roles.role-list')
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

@stop

@push('scripts')

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
