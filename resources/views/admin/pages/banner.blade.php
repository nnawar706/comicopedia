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
        <div class="accordion accordion-flush" id="accordionFlushExample">
            <h2 class="accordion-header" id="flush-headingOne">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                    Top Banners
                </button>
            </h2>
            <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                <div class="accordion-body">
                    <div class="card card-body">
                        <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <img src="{{ asset('uploads/general/1687025780980.png') }}" height="300" class="d-block w-100" alt="...">
                                </div>
                                <div class="carousel-item">
                                    <img src="{{ asset('uploads/general/1687025780980.png') }}" height="300" class="d-block w-100" alt="...">
                                </div>
                                <div class="carousel-item">
                                    <img src="{{ asset('uploads/general/1687025780980.png') }}" height="300" class="d-block w-100" alt="...">
                                </div>
                            </div>
                            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>
                        <a href="/admin/banners/1" class="text-center" style="margin-top:20px;">
                            <button type="button" class="btn btn-primary">
                                Update
                            </button>
                        </a>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="updateLogo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h6 class="modal-title" id="exampleModalLabel1">Update Website Logo</h6>
                        </div>
                        <div class="modal-body image-body text-center">
                            <form action="{{ route('update-info') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="file-drop-area">
                                    <span class="choose-file-button">Choose File</span>
                                    <span class="file-message">or drag and drop file here</span>
                                    <input type="file" name="logo" class="file-input" accept=".jpg,.jpeg,.png" required>
                                </div>
                                <div id="imagePreview"></div>
                                <hr>
                                <button type="submit" class="btn btn-primary">Update Logo</button>
                            </form>
                        </div>
                    </div>
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
