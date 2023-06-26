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
                                    <form method="post" action="">
                                        <div class="row g-2 mb-3">
                                            <div class="col-md">
                                                <div class="form-floating">
                                                    <input type="number" class="form-control" id="floatingInputGrid"
                                                    name="quantity" value="{{ $data['quantity'] }}" {{ auth()->guard('admin')->user()->hasPermissionTo('update volume') ? 'required' : 'readonly' }}>
                                                    <label for="floatingInputGrid">Update Stock</label>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row g-2 mb-3">
                                            <div class="col-md">
                                                <div class="form-floating">
                                                    <input type="number" class="form-control" id="floatingInputGrid"
                                                    name="damage_count" value="{{ $data['damage_count'] }}" {{ auth()->guard('admin')->user()->hasPermissionTo('update volume') ? 'required' : 'readonly' }}>
                                                    <label for="floatingInputGrid">Damage Count</label>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row g-2 mb-3">
                                            <div class="col-md">
                                                <div class="form-floating">
                                                    <input type="text" class="form-control" id="floatingInputGrid" name="discount"
                                                    value="{{ $data['discount'] }}" {{ auth()->guard('admin')->user()->hasPermissionTo('update volume') ? 'required' : 'readonly' }}>
                                                    <label for="floatingInputGrid">Discount(%)</label>
                                                </div>
                                            </div>
                                            <div class="col-md">
                                                <div class="form-floating">
                                                    <input type="date" class="form-control" id="floatingInputGrid" name="discount_active_till"
                                                    value="{{ $data['discount_active_till'] }}" {{ auth()->guard('admin')->user()->hasPermissionTo('update volume') ? 'required' : 'readonly' }}>
                                                    <label for="floatingInputGrid">Validity</label>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                    @if(auth()->guard('admin')->user()->hasPermissionTo('update volume'))
                                    <button type="submit" class="btn btn-primary" style="margin-left: 43%">
                                        Update
                                    </button>
                                    @endif
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
