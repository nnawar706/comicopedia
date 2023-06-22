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
        <!-- Page Heading -->
        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin-dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('show-items') }}">Volumes</a></li>
                <li class="breadcrumb-item active" aria-current="page">New Volume</li>
            </ol>
        </nav>
        <div class="row">
            <div class="col-lg-8 offset-lg-2">
                <hr>
                <form method="post" action="{{ route('create-volume') }}" enctype="multipart/form-data">
                    @csrf
                    @foreach($data['catalogues'] as $item)
                        @if($item['name'] == 'Offers')
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="catalogue_id" id="inlineRadio{{ $item['id'] }}" onclick="showDiscount()" value="{{ $item['id'] }}">
                                <label class="form-check-label" for="inlineRadio1">{{ $item['name'] }}</label>
                            </div>
                        @elseif($item['name'] == 'Upcoming Releases')
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="catalogue_id" id="inlineRadio{{ $item['id'] }}" onclick="showRelease()" value="{{ $item['id'] }}">
                                <label class="form-check-label" for="inlineRadio1">{{ $item['name'] }}</label>
                            </div>
                        @else
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="catalogue_id" id="inlineRadio{{ $item['id'] }}" onclick="hideAll()" value="{{ $item['id'] }}">
                                <label class="form-check-label" for="inlineRadio1">{{ $item['name'] }}</label>
                            </div>
                        @endif
                    @endforeach
                    <br><br>
                    <div class="row g-2 mb-3">
                        <div class="col-md">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="floatingInputGrid" name="title" required>
                                <label for="floatingInputGrid">Title</label>
                            </div>
                        </div>
                    </div>
                    <div class="row g-2 mb-3">
                        <div class="col-md">
                            <div class="form-floating">
                                <select class="form-select" name="item_id" id="floatingSelectGrid" aria-label="Floating label select example" required>
                                    <option selected>Select Series</option>
                                    @foreach($data['items'] as $item)
                                        <option value="{{ $item['id'] }}">{{ $item['title'] }}</option>
                                    @endforeach
                                </select>
                                <label for="floatingSelectGrid">Series</label>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="form-floating">
                            <textarea class="form-control" name="details" id="floatingTextarea2" style="height: 120px" required></textarea>
                            <label for="floatingTextarea2">Details</label>
                        </div>
                    </div>
                    <div class="row g-2 mb-3">
                        <div class="col-md">
                            <div class="form-floating">
                                <input type="number" class="form-control" id="floatingInputGrid" name="quantity" required>
                                <label for="floatingInputGrid">Quantity</label>
                            </div>
                        </div>
                        <div class="col-md">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="floatingInputGrid" name="cost" required>
                                <label for="floatingInputGrid">Cost Per Item</label>
                            </div>
                        </div>
                    </div>
                    <div class="row g-2 mb-3">
                        <div class="col-md">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="floatingInputGrid" name="price" required>
                                <label for="floatingInputGrid">Price</label>
                            </div>
                        </div>
                    </div>
                    <div class="row g-2 mb-3" id="discountDiv" style="display: none;">
                        <div class="col-md">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="floatingInputGrid" name="discount_price">
                                <label for="floatingInputGrid">Discount Price</label>
                            </div>
                        </div>
                        <div class="col-md">
                            <div class="form-floating">
                                <input type="date" class="datepicker form-control" id="floatingInputGrid" name="discount_valid_till">
                                <label for="floatingInputGrid">Discount Valid Till</label>
                            </div>
                        </div>
                    </div>
                    <div class="row g-2 mb-3" id="releaseDiv" style="display: none;">
                        <div class="col-md">
                            <div class="form-floating">
                                <input type="date" class="form-control" id="floatingInputGrid" name="release_date">
                                <label for="floatingInputGrid">Release Date</label>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="file-drop-area">
                            <span class="choose-file-button">Choose Image File (.png,.jpg,.jpeg)</span>
                            <span class="file-message">or drag and drop file here</span>
                            <input type="file" name="image" class="file-input" accept=".jpg,.jpeg,.png" required>
                        </div>
                        <div id="imagePreview"></div>
                    </div>
                    <div class="modal-footer">
                        <a href="{{ route('show-volumes') }}"><button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button></a>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@stop
