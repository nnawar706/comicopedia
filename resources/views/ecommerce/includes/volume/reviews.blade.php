<div class="col-lg-12">
    <div class="product__details__tab">
        <ul class="nav nav-tabs" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#tabs-1" role="tab"
                   aria-selected="true">Information</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#tabs-3" role="tab"
                   aria-selected="false">Reviews <span>({{ $data['info']['review_count'] }})</span></a>
            </li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane active" id="tabs-1" role="tabpanel">
                <div class="product__details__tab__desc">
                    <h6>Summary</h6>
                    <p>{{ $data['info']['details'] }}</p>
                </div>
            </div>
            <div class="tab-pane" id="tabs-3" role="tabpanel">
                <div class="product__details__tab__desc">
                    <div class="row">
                        <div class="col-md-6">
                            <h6 class="mb-4">Latest Customer Reviews</h6>
                            <hr>
                            @for($i=count($data['info']['reviews'])-1;$i>=0;$i--)
                            <div class="media mb-4">
                                <img src="{{ $data['info']['reviews'][$i]->user==null ? 'https://ui-avatars.com/api/?name=A&color=7F9CF5&background=EBF4FF' : $data['info']['reviews'][$i]->user->profile_photo_url }}" alt="reviewer-image" class="img-fluid mr-3 mt-1" style="width: 45px;">
                                <div class="media-body">
                                    <h6 style="margin-bottom: 2px">{{ $data['info']['reviews'][$i]->user==null ? 'Anonymous' : $data['info']['reviews'][$i]->user->name }}<small> - <i>{{ \Carbon\Carbon::parse($data['info']['reviews'][$i]->created_at)->format('F d, Y') }}</i></small></h6>
                                    <div style="margin-bottom: 4px">
                                        @if($data['info']['reviews'][$i]->rating == 1)
                                            <i class="fas fa-star" style="color:#FFC300"></i>
                                            <i class="fas fa-star" style="color:#D9D9D9"></i>
                                            <i class="fas fa-star" style="color:#D9D9D9"></i>
                                            <i class="fas fa-star" style="color:#D9D9D9"></i>
                                            <i class="fas fa-star" style="color:#D9D9D9"></i>
                                        @elseif($data['info']['reviews'][$i]->rating == 2)
                                            <i class="fas fa-star" style="color:#FFC300"></i>
                                            <i class="fas fa-star" style="color:#FFC300"></i>
                                            <i class="fas fa-star" style="color:#D9D9D9"></i>
                                            <i class="fas fa-star" style="color:#D9D9D9"></i>
                                            <i class="fas fa-star" style="color:#D9D9D9"></i>
                                        @elseif($data['info']['reviews'][$i]->rating == 3)
                                            <i class="fas fa-star" style="color:#FFC300"></i>
                                            <i class="fas fa-star" style="color:#FFC300"></i>
                                            <i class="fas fa-star" style="color:#FFC300"></i>
                                            <i class="fas fa-star" style="color:#D9D9D9"></i>
                                            <i class="fas fa-star" style="color:#D9D9D9"></i>
                                        @elseif($data['info']['reviews'][$i]->rating == 4)
                                            <i class="fas fa-star" style="color:#FFC300"></i>
                                            <i class="fas fa-star" style="color:#FFC300"></i>
                                            <i class="fas fa-star" style="color:#FFC300"></i>
                                            <i class="fas fa-star" style="color:#FFC300"></i>
                                            <i class="fas fa-star" style="color:#D9D9D9"></i>
                                        @elseif($data['info']['reviews'][$i]->rating == 5)
                                            <i class="fas fa-star" style="color:#FFC300"></i>
                                            <i class="fas fa-star" style="color:#FFC300"></i>
                                            <i class="fas fa-star" style="color:#FFC300"></i>
                                            <i class="fas fa-star" style="color:#FFC300"></i>
                                            <i class="fas fa-star" style="color:#FFC300"></i>
                                        @else
                                            <i class="fas fa-star" style="color:#D9D9D9"></i>
                                            <i class="fas fa-star" style="color:#D9D9D9"></i>
                                            <i class="fas fa-star" style="color:#D9D9D9"></i>
                                            <i class="fas fa-star" style="color:#D9D9D9"></i>
                                            <i class="fas fa-star" style="color:#D9D9D9"></i>
                                        @endif
                                    </div>
                                    <p>{{ $data['info']['reviews'][$i]['comment'] }}</p>
                                </div>
                            </div>
                            @endfor
                        </div>
                        <div class="col-md-6">
                            <h6 class="mb-4">Leave a review</h6>
                            <form method="post" action="{{ route('rate-volume', ['id' => $data['info']['id']]) }}">
                                @csrf
                                <div class="d-flex my-3">
                                    <div class="mb-0 mr-2">
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" class="custom-control-input" id="rate-1" value="5" name="rating">
                                            <label class="custom-control-label" for="rate-1">Excellent</label>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" class="custom-control-input" id="rate-2" value="4" name="rating">
                                            <label class="custom-control-label" for="rate-2">Very Good</label>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" class="custom-control-input" id="rate-3" value="3" name="rating">
                                            <label class="custom-control-label" for="rate-3">Good</label>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" class="custom-control-input" id="rate-4" value="2" name="rating">
                                            <label class="custom-control-label" for="rate-4">Bad</label>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" class="custom-control-input" id="rate-5" value="1" name="rating">
                                            <label class="custom-control-label" for="rate-5">Very Bad</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="message">Comment</label>
                                    <textarea id="message" cols="30" rows="5" name="comment" class="form-control"></textarea>
                                </div>
                                <div class="form-group mb-0">
                                    <button type="submit" class="btn primary-btn px-3">Leave Your Review</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
