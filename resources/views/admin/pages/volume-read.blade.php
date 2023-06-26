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
        <!-- Page Heading -->
        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin-dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('show-volumes') }}">Series</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $data['item']['title']}}, {{ $data['title'] }}</li>
            </ol>
        </nav>
        <div class="row">
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    In Stock</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $data['quantity'] }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-calendar fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    Earnings</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">$215,000</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-money-bill fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Ratings
                                </div>
                                <div class="row no-gutters align-items-center">
{{--                                    @if (($data['like_count'] + $data['dislike_count']) != 0)--}}
                                        <div class="col-auto">
                                            <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">67%</div>
                                        </div>
                                        <div class="col">
                                            <div class="progress progress-sm mr-2">
                                                <div class="progress-bar bg-info" role="progressbar"
                                                     style="width: 67%" aria-valuenow="67" aria-valuemin="0"
                                                     aria-valuemax="100"></div>
                                            </div>
                                        </div>
{{--                                    @else--}}
{{--                                        <div class="col-auto">--}}
{{--                                            <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">0%</div>--}}
{{--                                        </div>--}}
{{--                                        <div class="col">--}}
{{--                                            <div class="progress progress-sm mr-2">--}}
{{--                                                <div class="progress-bar bg-info" role="progressbar"--}}
{{--                                                     style="width: 0%" aria-valuenow="0" aria-valuemin="0"--}}
{{--                                                     aria-valuemax="100"></div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    @endif--}}


                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                    Visitors</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $data['view_count'] }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-comments fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-6">
                <div class="card shadow mb-4">
                    <div
                        class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">{{ $data['product_unique_id'] }} | {{ $data['item']['title'] }}, {{ $data['title'] }}</h6>
                        <div class="dropdown no-arrow">
                            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                 aria-labelledby="dropdownMenuLink">
                                <div class="dropdown-header">Actions</div>
                                <a class="dropdown-item" href="#">Export Data</a>
                                <a class="dropdown-item" href="#">Another action</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#">Something else here</a>
                            </div>
                        </div>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4" style="position: relative;">
                                <img src="{{ asset($data['image_path']) }}" height="400" width="200" alt="series-image">
                                <div style="position: absolute;top:0;left:0;z-index: 10">
                                    <span class="text-white bg-danger" style="padding: 5px"><i class="fas fa-info-circle"></i> {{ $data['catalogue']['name'] }}</span>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <p><b>Author:</b> {{ $data['item']['author'] }}<br>
                                    <b>Magazine:</b> {{ $data['item']['magazine'] }}<br>
                                    <b>Genre:</b> {{ $data['item']['genre']['name'] }}<br>
                                    <b>Details:</b> {{ $data['details'] }}<br></p>
                                <hr>
                                <b>Tags:</b> {{ $data['item']['meta_keywords'] }}<br>

                                <br>
{{--                                <span style="margin-right:20px;"><i class="fas fa-thumbs-up" style="color:#4e73df"></i> {{ $data['like_count'] }} </span> |--}}
{{--                                <span style="margin-left:20px;"> <i class="fas fa-thumbs-down" style="color:#4e73df"></i> {{ $data['dislike_count'] }}</span>--}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card shadow mb-4">
                    <!-- Card Header - Accordion -->
                    <a href="#collapseCardExample" class="d-block card-header py-3" data-toggle="collapse"
                       role="button" aria-expanded="true" aria-controls="collapseCardExample">
                        <h6 class="m-0 font-weight-bold text-primary">Overview</h6>
                    </a>
                    <!-- Card Content - Collapse -->
                    <div class="collapse show" id="collapseCardExample">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="col-md">
                                        <div class="form-floating">
                                            <input type="number" class="form-control" id="floatingInputGrid" name="quantity" value="{{ $data['quantity'] }}" required>
                                            <label for="floatingInputGrid">Update Stock</label>
                                        </div>
                                    </div>
                                    <div class="col-md">
                                        <div class="form-floating">
                                            <input type="number" class="form-control" id="floatingInputGrid" name="damage" value="{{ $data['quantity'] }}" required>
                                            <label for="floatingInputGrid">Damage Count</label>
                                        </div>
                                    </div>
                                    <hr>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

@stop

{{--@push('scripts')--}}

{{--    <script src="{{ asset('assets/chart.js/Chart.min.js') }}"></script>--}}
{{--    <script src="{{ asset('assets/js/charts/chart-bar-demo.js') }}"></script>--}}

{{--@endpush--}}
