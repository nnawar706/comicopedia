            <div class="col-lg-8 offset-lg-2">
                <!-- Profile Information -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Profile Information</h6>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Email address</label>
                            <input type="email" class="form-control" id="exampleFormControlInput1" value="{{ auth()->guard('admin')->user()->email }}">
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Name</label>
                            <input type="email" class="form-control" id="exampleFormControlInput1" value="{{ auth()->guard('admin')->user()->name }}">
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Contact</label>
                            <input type="email" class="form-control" id="exampleFormControlInput1" value="{{ auth()->guard('admin')->user()->contact }}">
                        </div>
                        <a href="#" class="btn btn-primary btn-icon-split">
                            <span class="text">Update Information</span>
                        </a>
                    </div>
                </div>
            </div>