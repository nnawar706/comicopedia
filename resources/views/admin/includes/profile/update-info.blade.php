            <div class="col-lg-8 offset-lg-2">
                <!-- Profile Information -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Profile Information</h6>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#updateImage" data-whatever="@mdo">
                                <img src="{{ asset(auth()->guard('admin')->user()->profile_photo_path) }}" class="rounded mx-auto d-block" alt="admin-profile-photo">
                            </button>
                        </div>
                        <form method="post" action="{{ route('admin-change-info') }}">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Email address</label>
                            <input type="email" class="form-control" id="exampleFormControlInput1" name="email" value="{{ auth()->guard('admin')->user()->email }}">
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Name</label>
                            <input type="text" class="form-control" id="exampleFormControlInput1" name="name" value="{{ auth()->guard('admin')->user()->name }}">
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Contact</label>
                            <input type="text" class="form-control" id="exampleFormControlInput1" name="contact" value="{{ auth()->guard('admin')->user()->contact }}">
                        </div>
                        <button type="submit" class="btn"><a href="#" class="btn btn-primary btn-icon-split">
                            <span class="text">Update Information</span>
                        </a></button>
                        </form>
                    </div>

                    <div class="modal fade" id="updateImage" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h6 class="modal-title" id="exampleModalLabel">Update Profile Photo</h6>
                                </div>
                                <div class="modal-body image-body text-center">
                                    <form action="{{ route('admin-change-photo') }}" method="post">
                                        @csrf
                                        <div class="file-drop-area">
                                            <span class="choose-file-button">Choose Files</span>
		                                    <span class="file-message">or drag and drop files here</span>
		                                    <input type="file" name="image" class="file-input" accept=".jfif,.jpg,.jpeg,.png,.gif" required>
                                        </div>
                                        <div id="imagePreview"></div>
                                        <hr>
                                        <button type="submit" class="btn btn-primary">Update Photo</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>