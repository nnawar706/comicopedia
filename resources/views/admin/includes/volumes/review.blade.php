<div class="col-lg-6">
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Customer Reviews</h6>
        </div>
        <div class="card-body reviews">
            <div class="review-slider">
                @if($rate == 0)
                <div class="text-center">No review found</div>
                @else
                @foreach($data['reviews'] as $review)
                <div class="text-center">
                    @if($review->user==null)
                        <img class="img-profile rounded-circle"
                        src="https://ui-avatars.com/api/?name=A&color=7F9CF5&background=EBF4FF" height="50" width="50" alt="reviewer-image">
                        <br>
                        <span style="font-size:12px;color:#BFBFBF">Anonymous</span>
                    @else
                        <img class="img-profile rounded-circle"
                        src="{{ $review['user']['profile_photo_url'] }}" height="45" width="45" alt="reviewer-image">
                        <br>
                        <span style="font-size:12px;color:#BFBFBF">{{ $review->user->name }}</span>
                    @endif
                    <div>
                        @if($review->rating === 1)
                            <i class="fas fa-star" style="color:#FFC300"></i>
                            <i class="fas fa-star" style="color:#D9D9D9"></i>
                            <i class="fas fa-star" style="color:#D9D9D9"></i>
                            <i class="fas fa-star" style="color:#D9D9D9"></i>
                            <i class="fas fa-star" style="color:#D9D9D9"></i>
                        @elseif($review->rating === 2)
                            <i class="fas fa-star" style="color:#FFC300"></i>
                            <i class="fas fa-star" style="color:#FFC300"></i>
                            <i class="fas fa-star" style="color:#D9D9D9"></i>
                            <i class="fas fa-star" style="color:#D9D9D9"></i>
                            <i class="fas fa-star" style="color:#D9D9D9"></i>
                        @elseif($review->rating === 3)
                            <i class="fas fa-star" style="color:#FFC300"></i>
                            <i class="fas fa-star" style="color:#FFC300"></i>
                            <i class="fas fa-star" style="color:#FFC300"></i>
                            <i class="fas fa-star" style="color:#D9D9D9"></i>
                            <i class="fas fa-star" style="color:#D9D9D9"></i>
                        @elseif($review->rating === 4)
                            <i class="fas fa-star" style="color:#FFC300"></i>
                            <i class="fas fa-star" style="color:#FFC300"></i>
                            <i class="fas fa-star" style="color:#FFC300"></i>
                            <i class="fas fa-star" style="color:#FFC300"></i>
                            <i class="fas fa-star" style="color:#D9D9D9"></i>
                        @elseif($review->rating === 5)
                            <i class="fas fa-star" style="color:#FFC300"></i>
                            <i class="fas fa-star" style="color:#FFC300"></i>
                            <i class="fas fa-star" style="color:#FFC300"></i>
                            <i class="fas fa-star" style="color:#FFC300"></i>
                            <i class="fas fa-star" style="color:#FFC300"></i>
                        @endif
                    </div>
                    <p style="font-size:14px">{{ $review->comment}}</p>
                    <a href="/admin/review/delete/{{ $review['id'] }}">
                        <button class="btn btn-danger btn-circle btn-sm">
                            <i class="fas fa-trash"></i>
                        </button>
                    </a>
                </div>
                <hr>
                @endforeach
                @endif
            </div>
        </div>
    </div>
</div>
