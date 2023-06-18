                    <div class="accordion-item">
                        <h2 class="accordion-header" id="flush-headingThree">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
                                Social Media Information
                            </button>
                        </h2>
                        <div id="flush-collapseThree" class="accordion-collapse collapse" aria-labelledby="flush-headingThree" data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body">
                                <br>
                                <form method="post" action="{{ route('update-info') }}">
                                    @csrf
                                    <div class="input-group mb-3">
                                        <button class="btn btn-primary btn-circle" type="button" id="button-addon1" disabled>
                                            <i class="fab fa-facebook-f"></i>
                                        </button>
                                        <input type="text" class="form-control" name="facebook_url" value="{{ $data['website']['facebook_url'] }}">
                                    </div>
                                    <div class="input-group mb-3">
                                        <button class="btn btn-circle" type="button" id="button-addon1" style="background-color: #962fbf" disabled>
                                            <i class="fab fa-instagram" style="color: #fff"></i>
                                        </button>
                                        <input type="text" class="form-control" name="instagram_url" value="{{ $data['website']['instagram_url'] }}">
                                    </div>
                                    <div class="input-group mb-3">
                                        <button class="btn btn-danger btn-circle" type="button" id="button-addon1" disabled>
                                            <i class="fab fa-youtube"></i>
                                        </button>
                                        <input type="text" class="form-control" name="youtube_url" value="{{ $data['website']['youtube_url'] }}">
                                    </div>
                                    <div class="input-group mb-3">
                                        <button class="btn btn-danger btn-circle" type="button" id="button-addon1" disabled>
                                            <i class="fab fa-pinterest"></i>
                                        </button>
                                        <input type="text" class="form-control" name="pinterest_url" value="{{ $data['website']['pinterest_url'] }}">
                                    </div>
                                    <hr>
                                    <button type="submit" class="btn">
                                        <a href="#" class="btn btn-primary btn-icon-split"><span class="text">Update Information</span></a>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
