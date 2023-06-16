            <div class="col-lg-8 offset-lg-2">
                <!-- Update Password -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Change Password</h6>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('admin-change-pwd') }}">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Current Password</label>
                            <input type="password" class="form-control" id="exampleFormControlInput1" name="current_password" required autocomplete="off">
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">New Password</label>
                            <input type="password" class="form-control" id="exampleFormControlInput1" name="password" required autocomplete="off">
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Confirm New Password</label>
                            <input type="password" class="form-control" id="exampleFormControlInput1" name="password_confirmation" required autocomplete="off">
                        </div>
                        <button type="submit" class="btn"><a href="#" class="btn btn-primary btn-icon-split">
                            <span class="text">Change Password</span>
                        </a></button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="updateImage" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h6 class="modal-title" id="exampleModalLabel">Update Profile Photo</h6>
                                </div>
                                <div class="modal-body image-body text-center">
                                    <form action="{{ route('admin-change-photo') }}" method="post" enctype="multipart/form-data">
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