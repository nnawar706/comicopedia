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
                <h5 class="h4 mb-1 text-gray-800">General Setting</h5>
                <p style="color:darkgray; font-size:12px">Last edited on {{ $data['website']['updated_at'] }}</p>
                <br>
                <div class="accordion accordion-flush" id="accordionFlushExample">
                    @include('admin.includes.setting.logo-favicon')

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

                    <div class="modal fade" id="updateFavicon" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel2"
                        aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h6 class="modal-title" id="exampleModalLabel2">Update Website Logo</h6>
                                </div>
                                <div class="modal-body image-body text-center">
                                    <form action="{{ route('update-info') }}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <div class="file-drop-area">
                                            <span class="choose-file-button">Choose File</span>
                                            <span class="file-message">or drag and drop file here</span>
                                            <input type="file" name="favicon" class="file-input" accept=".jpg,.jpeg,.png" required>
                                        </div>
                                        <div id="faviconPreview"></div>
                                        <hr>
                                        <button type="submit" class="btn btn-primary">Update Favicon</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    @include('admin.includes.setting.site-info')

                    @include('admin.includes.setting.social-media')

                    @include('admin.includes.setting.config')
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
