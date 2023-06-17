@extends('admin.layouts.default')

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-8 offset-lg-2">
                <h5 class="h4 mb-1 text-gray-800">General Setting</h5>
                <br>
                <p>
                    <a class="btn btn-primary" data-bs-toggle="collapse" href="#collapseExample1" role="button"
                        aria-expanded="true" aria-controls="collapseExample1">
                        Logo & Favicon
                    </a>
                    <a class="btn btn-primary" data-bs-toggle="collapse" href="#collapseExample2" role="button"
                        aria-expanded="false" aria-controls="collapseExample2">
                        Contact Information
                    </a>
                    <a class="btn btn-primary" data-bs-toggle="collapse" href="#collapseExample3" role="button"
                        aria-expanded="false" aria-controls="collapseExample3">
                        Website Information
                    </a>
                    <a class="btn btn-primary" data-bs-toggle="collapse" href="#collapseExample4" role="button"
                        aria-expanded="false" aria-controls="collapseExample4">
                        Social Media
                    </a>
                </p>
                <div class="collapse show" id="collapseExample1">
                    <div class="card card-body">
                        <label for="exampleFormControlInput1" class="form-label">Website Logo:</label>

                        <button type="button" class="btn" title="Update Logo Image" data-bs-toggle="modal"
                            data-bs-target="#updateLogo" data-whatever="@mdo">
                            <img src="{{ asset($data['logo_path']) }}" class="rounded mx-auto d-block" alt="site-logo"
                                height="100" width="100">
                        </button>
                        <hr>
                        <label for="exampleFormControlInput2" class="form-label">Website Favicon:</label>

                        <button type="button" class="btn" title="Update Favicon Image" data-bs-toggle="modal"
                            data-bs-target="#updateFavicon" data-whatever="@mdo">
                            <img src="{{ asset($data['favicon_path']) }}" class="rounded mx-auto d-block" alt="site-favicon"
                                height="100" width="100">
                        </button>
                    </div>
                </div>
                <div class="collapse" id="collapseExample2">
                    <div class="card card-body">
                        Some placeholder content for the collapse component.
                    </div>
                </div>
                <div class="collapse" id="collapseExample3">
                    <div class="card card-body">
                        This panel is hidden by default but revealed when the user activates the relevant trigger.
                    </div>
                </div>
                <div class="collapse" id="collapseExample4">
                    <div class="card card-body">
                        This panel is hidden by default but revealed when the user activates the relevant trigger.
                    </div>
                </div>
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

@stop
