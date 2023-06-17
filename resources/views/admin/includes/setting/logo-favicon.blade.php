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
