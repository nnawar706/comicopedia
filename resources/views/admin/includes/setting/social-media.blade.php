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
                                    <hr>
                                    <button type="submit" class="btn">
                                        <a href="#" class="btn btn-primary btn-icon-split"><span class="text">Update Information</span></a>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
