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
                <br>
                <div class="accordion accordion-flush" id="accordionFlushExample">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="flush-headingOne">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                                Logo & Favicon
                            </button>
                        </h2>
                        <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body">
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
                        </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="flush-headingTwo">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                                Website Information
                            </button>
                        </h2>
                        <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body">
                                <br>
                                <form method="post" action="{{ route('update-info') }}">
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">Website Name</label>
                                        <input type="text" class="form-control" id="exampleFormControlInput1" name="name" value="{{ $data['name'] }}">
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput2" class="form-label">Email address</label>
                                        <input type="email" class="form-control" id="exampleFormControlInput2" name="email" value="{{ $data['email'] }}">
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput3" class="form-label">Conatct</label>
                                        <input type="contact" class="form-control" id="exampleFormControlInput3" name="contact" value="{{ $data['contact'] }}">
                                    </div>
                                    <hr>
                                    <label for="floatingTextarea2">About</label>
                                    <div class="form-floating">
                                        <textarea class="form-control" name="about" id="floatingTextarea2" style="height: 120px">{{ $data['about'] }}</textarea>
                                    </div>
                                    <button type="submit" class="btn">
                                        <a href="#" class="btn btn-primary btn-icon-split"><span class="text">Update Information</span></a>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="flush-headingThree">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
                                Social Media Information
                            </button>
                        </h2>
                        <div id="flush-collapseThree" class="accordion-collapse collapse" aria-labelledby="flush-headingThree" data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body">Placeholder content for this accordion, which is intended to demonstrate the <code>.accordion-flush</code> class. This is the third item's accordion body. Nothing more exciting happening here in terms of content, but just filling up the space to make it look, at least at first glance, a bit more representative of how this would look in a real-world application.</div>
                        </div>
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
