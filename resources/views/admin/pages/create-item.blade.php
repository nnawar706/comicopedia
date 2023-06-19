@extends('admin.layouts.default')

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-8 offset-lg-2">
            <br>
            <h5 class="h5 mb-1 text-gray-800">Add New Series</h5>
            <br>
            <hr>
            <form>
                <div class="row g-2 mb-3">
                    <div class="col-md">
                        <div class="form-floating">
                            <input type="email" class="form-control" id="floatingInputGrid" name="author">
                            <label for="floatingInputGrid">Title</label>
                        </div>
                    </div>
                </div>
                <div class="row g-2 mb-3">
                    <div class="col-md">
                        <div class="form-floating">
                            <input type="email" class="form-control" id="floatingInputGrid" name="author">
                            <label for="floatingInputGrid">Author Name</label>
                        </div>
                    </div>
                    <div class="col-md">
                        <div class="form-floating">
                            <input type="email" class="form-control" id="floatingInputGrid" name="author">
                            <label for="floatingInputGrid">Magazine</label>
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="form-floating">
                            <select class="form-select" id="floatingSelectGrid" aria-label="Floating label select example">
                                <option selected>Select Genre</option>
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select>
                            <label for="floatingSelectGrid">Genre</label>
                        </div>
                </div>
                <div class="mb-3">
                    <div class="form-floating">
                        <textarea class="form-control" name="detail" id="floatingTextarea2" style="height: 120px"></textarea>
                        <label for="floatingTextarea2">Details</label>
                    </div>
                </div>
                <div class="row g-2 mb-3">
                    <div class="col-md">
                        <div class="form-floating">
                            <input type="email" class="form-control" id="floatingInputGrid" name="author" aria-describedby="HelpBlock">
                            <label for="floatingInputGrid">Keywords</label>
                            <div id="passwordHelpBlock" class="form-text">
                                Insert comma seperated keywords to better describe the series.
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="file-drop-area">
                        <span class="choose-file-button">Choose Imgae File</span>
                        <span class="file-message">or drag and drop file here</span>
                        <input type="file" name="logo" class="file-input" accept=".jpg,.jpeg,.png" required>
                    </div>
                    <div id="imagePreview"></div>
                </div>
                <div class="modal-footer">
                    <a href="{{ route('show-items') }}"><button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button></a>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

@stop
