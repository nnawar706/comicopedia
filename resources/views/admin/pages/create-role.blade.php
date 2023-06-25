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

@if (isset($message))
    <div class="toast show fixed-bottom ms-auto text-bg-danger" style="--bs-bg-opacity: .8;" animation="true" aria-live="assertive" aria-atomic="true">
        <div class="d-flex">
            <div class="toast-body">
                {{ $message }}
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
                    <li class="breadcrumb-item"><a href="{{ route('role-list') }}">Roles</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Add</li>
                </ol>
            </nav>
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h6 class="h4 mb-0 text-gray-800">New Role</h6>
            </div>
            <hr>
                <form method="post" action="{{ route('create-role') }}">
                    @csrf
                    <div class="row g-2 mb-3">
                        <div class="col-md">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="floatingInputGrid" name="role" required>
                                <label for="floatingInputGrid">Role</label>
                            </div>
                        </div>
                    </div>
                    Permissions:<hr>
                    <div class="row">
                        <div class="col-md-3">
                    @foreach ($data as $index => $permission)
                        @if($index%15 == 0 && $index!=0)
                            </div><div class="col-md-3">
                        @endif
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="permissions[]" value="{{ $permission->id }}">
                            <label class="form-check-label" for="flexCheckDefault">
                                {{ $permission->name }}
                            </label>
                        </div>
                    @endforeach
                    </div>
                    <div class="modal-footer">
                        <a href="{{ route('role-list') }}"><button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button></a>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div></div>
                </form>
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
